<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function dashboard(): View|RedirectResponse
    {
        if (in_array(Auth::user()->role, ['admin', 'staff'], true)) {
            return redirect()->route('staff.dashboard');
        }

        return view('dashboard');
    }

    public function cart(): View
    {
        return view('customer.cart');
    }

    public function checkout(): View
    {
        return view('customer.checkout');
    }

    public function qrOrder(Request $request): View|\Illuminate\Contracts\View\View
    {
        $tableNumber = $request->query('table');

        if ($tableNumber !== null) {
            $exists = DB::table('tables')->where('table_number', (int) $tableNumber)->exists();
            if (!$exists) {
                abort(404, "Table {$tableNumber} does not exist.");
            }
        }

        return view('customer.qr-order');
    }

    public function orderStatus(): View
    {
        return view('customer.order-status');
    }

    public function orderHistory(Request $request): View
    {
        $orders = Order::withCount('items')
            ->where('user_id', Auth::id())
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('from'), fn ($query) => $query->whereDate('created_at', '>=', $request->from))
            ->when($request->filled('to'), fn ($query) => $query->whereDate('created_at', '<=', $request->to))
            ->latest()
            ->get();

        return view('customer.order-history', compact('orders'));
    }

    public function profile(): View
    {
        return view('customer.profile');
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'fullName' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'currentPassword' => ['nullable', 'string'],
            'newPassword' => ['nullable', 'string', 'min:8'],
        ]);

        if (! empty($validated['newPassword'])) {
            if (! Hash::check($validated['currentPassword'] ?? '', $user->password)) {
                return back()->with('error', 'wrong_pw');
            }

            $user->password = Hash::make($validated['newPassword']);
        }

        $user->full_name = $validated['fullName'];
        $user->phone = $validated['phone'] ?? null;
        $user->address = $validated['address'] ?? null;
        $user->save();

        return back()->with('success', true);
    }

    public function storeOrder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'custName' => ['required', 'string', 'max:100'],
            'custPhone' => [Rule::requiredIf(fn() => in_array($request->orderType, ['pickup', 'delivery'])), 'nullable', 'string', 'max:20'],
            'orderType' => ['required', Rule::in(['dine-in', 'takeaway', 'pickup', 'delivery'])],
            'tableNumber' => ['nullable', 'integer', 'min:1', Rule::exists('tables', 'table_number')],
            'paxNumber' => ['nullable', 'integer', 'min:1'],
            'address' => ['nullable', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:500'],
            'paymentMethod' => ['nullable', Rule::in(['cash', 'online_transfer'])],
            'receipt' => ['nullable', 'file', 'mimetypes:image/jpeg,image/png,application/pdf', 'max:5120'],
            'cartData' => ['required', 'json'],
            'custEmail' => [
                Rule::requiredIf(fn() => !Auth::check() && in_array($request->orderType, ['pickup', 'delivery'])),
                'nullable', 'email', 'max:255',
            ],
        ]);

        $cartItems = collect(json_decode($validated['cartData'], true))
            ->filter(fn ($item) => isset($item['id'], $item['name'], $item['price'], $item['quantity']));

        if ($cartItems->isEmpty()) {
            return redirect()->route('customer.cart');
        }

        $subtotal = $cartItems->sum(fn ($item) => (float) $item['price'] * (int) $item['quantity']);
        $tax = round($subtotal * 0.06, 2);
        $deliveryFee = $validated['orderType'] === 'delivery' ? 3.00 : 0.00;
        $total = $subtotal + $tax + $deliveryFee;

        $order = DB::transaction(function () use ($validated, $cartItems, $subtotal, $tax, $deliveryFee, $total, $request) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $validated['custName'],
                'customer_phone' => $validated['custPhone'] ?? '-',
                'order_type' => $validated['orderType'],
                'table_number' => $validated['tableNumber'] ?? null,
                'pax' => $validated['paxNumber'] ?? null,
                'delivery_address' => $validated['address'] ?? null,
                'special_notes' => $validated['notes'] ?? null,
                'payment_method' => $validated['paymentMethod'] ?? 'cash',
                'receipt_path' => null,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'delivery_fee' => $deliveryFee,
                'total' => $total,
                'status' => 'pending',
            ]);

            $cartItems->each(function ($item) use ($order) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => max(1, (int) $item['id']),
                    'item_name' => (string) $item['name'],
                    'unit_price' => (float) $item['price'],
                    'quantity' => (int) $item['quantity'],
                    'line_total' => (float) $item['price'] * (int) $item['quantity'],
                ]);
            });

            if ($request->hasFile('receipt')) {
                $file = $request->file('receipt');
                $timestamp = time();
                $ext = $file->getClientOriginalExtension();
                $filename = "{$order->id}_{$timestamp}.{$ext}";
                
                // Member 4: move_uploaded_file() into assets/uploads/receipts/{order_id}_{timestamp}.ext
                $file->move(public_path('assets/uploads/receipts'), $filename);
                
                // Save relative path
                $order->update(['receipt_path' => "assets/uploads/receipts/{$filename}"]);
            }

            return $order;
        });

        // Send confirmation email for Pick Up and Delivery online orders only
        if (in_array($order->order_type, ['pickup', 'delivery'])) {
            $emailAddress = Auth::check()
                ? Auth::user()->email
                : ($validated['custEmail'] ?? null);
            if ($emailAddress) {
                $order->load('items');
                Mail::to($emailAddress)->send(new OrderConfirmationMail($order));
            }
        }

        $params = ['order_id' => $order->id];
        if ($request->input('qr')) {
            $params['qr'] = 1;
            if ($request->input('tableNumber')) $params['table'] = $request->input('tableNumber');
            if ($request->input('paxNumber')) $params['pax'] = $request->input('paxNumber');
        }
        return redirect()->route('customer.order-confirm', $params);
    }

    public function orderConfirm(Request $request): View
    {
        $order = Order::with('items')->find($request->query('order_id'));

        return view('customer.order-confirm', [
            'orderId' => $order?->id,
            'order'   => $order,
        ]);
    }

    public function checkTable(Request $request): JsonResponse
    {
        $tableNumber = $request->query('table');
        $exists = DB::table('tables')->where('table_number', $tableNumber)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function menuItemsJson(): JsonResponse
    {
        $items = \App\Models\MenuItem::where('is_available', true)
            ->orderBy('category')
            ->orderBy('name')
            ->get(['id', 'name', 'description', 'price', 'category', 'image_path']);

        return response()->json($items);
    }

    public function tableOrdersJson(Request $request): JsonResponse
    {
        $tableNumber = $request->query('table');
        if (!$tableNumber) {
            return response()->json(['success' => false, 'orders' => []]);
        }

        $orders = Order::with('items')
            ->where('table_number', $tableNumber)
            ->whereIn('status', ['pending', 'confirmed', 'preparing', 'ready'])
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'table' => $tableNumber,
            'orders' => $orders->map(fn($o) => [
                'id'            => $o->id,
                'created_at'    => $o->created_at->format('h:i A'),
                'order_type'    => $o->orderTypeLabel(),
                'status'        => $o->status,
                'total'         => $o->total,
                'items'         => $o->items->map(fn($i) => [
                    'name'     => $i->item_name,
                    'quantity' => $i->quantity,
                    'price'    => $i->line_total,
                ]),
            ]),
            'grand_total' => $orders->sum('total'),
        ]);
    }

    public function orderStatusJson(Request $request): JsonResponse
    {
        $order = Order::with('items')->where('id', $request->query('order_id'))
            ->when(Auth::check() && Auth::user()->role === 'customer', fn ($query) => $query->where('user_id', Auth::id()))
            ->first();

        if (! $order) {
            return response()->json(['success' => false]);
        }

        return response()->json([
            'success' => true,
            'order' => [
                'id' => $order->id,
                'created_at' => $order->created_at->format('d M Y, h:i A'),
                'customer_name' => $order->customer_name,
                'order_type' => $order->orderTypeLabel(),
                'status' => $order->status,
                'total' => $order->total,
                'items' => $order->items->map(fn($i) => [
                    'name'     => $i->item_name,
                    'quantity' => $i->quantity,
                    'price'    => $i->line_total,
                ]),
            ],
        ]);
    }
}

