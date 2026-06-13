<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function qrOrder(): View
    {
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
            'custPhone' => ['required', 'string', 'max:20'],
            'orderType' => ['required', Rule::in(['dine-in', 'takeaway', 'delivery'])],
            'tableNumber' => ['nullable', 'integer', 'min:1'],
            'address' => ['nullable', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:500'],
            'paymentMethod' => ['nullable', Rule::in(['cash', 'online_transfer'])],
            'receipt' => ['nullable', 'file', 'mimes:jpeg,png,pdf', 'max:5120'],
            'cartData' => ['required', 'json'],
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

        $receiptPath = null;
        if ($request->hasFile('receipt')) {
            $receiptPath = $request->file('receipt')->store('receipts', 'public');
        }

        $order = DB::transaction(function () use ($validated, $cartItems, $subtotal, $tax, $deliveryFee, $total, $receiptPath) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $validated['custName'],
                'customer_phone' => $validated['custPhone'],
                'order_type' => $validated['orderType'],
                'table_number' => $validated['tableNumber'] ?? null,
                'delivery_address' => $validated['address'] ?? null,
                'special_notes' => $validated['notes'] ?? null,
                'payment_method' => $validated['paymentMethod'] ?? 'cash',
                'receipt_path' => $receiptPath,
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

            return $order;
        });

        return redirect()->route('customer.order-confirm', ['order_id' => $order->id]);
    }

    public function orderConfirm(Request $request): View
    {
        return view('customer.order-confirm', [
            'orderId' => $request->query('order_id'),
        ]);
    }

    public function orderStatusJson(Request $request): JsonResponse
    {
        $order = Order::where('id', $request->query('order_id'))
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
                'order_type' => ucfirst($order->order_type),
                'status' => $order->status,
                'total' => $order->total,
            ],
        ]);
    }
}
