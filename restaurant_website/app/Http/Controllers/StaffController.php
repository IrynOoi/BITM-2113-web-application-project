<?php
// <!-- StaffController.php -->
namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class StaffController extends Controller
{
    private function authorizeStaff(): void
    {
        abort_unless(in_array(Auth::user()->role, ['admin', 'staff'], true), 403);
    }

    public function dashboard(): View
    {
        $this->authorizeStaff();

        $activeOrdersCount = Order::whereIn('status', ['pending', 'confirmed', 'preparing', 'ready'])->count();
        $allOrdersCount = Order::count();
        $menuItemsCount = MenuItem::count();
        $completedOrdersCount = Order::where('status', 'completed')->count();

        $orders = Order::with('user')->withCount('items')->latest()->take(10)->get();

        return view('staff.dashboard', compact(
            'orders',
            'activeOrdersCount',
            'allOrdersCount',
            'menuItemsCount',
            'completedOrdersCount'
        ));
    }

    public function orders(Request $request): View
    {
        $this->authorizeStaff();

        $statusFilter = $request->input('status', 'active');
        $dateFilter = $request->input('date', today()->toDateString());

        $orders = Order::with(['user', 'items'])->withCount('items')
            ->when($statusFilter === 'active', fn($q) => $q->whereIn('status', ['pending', 'confirmed', 'preparing', 'ready']))
            ->when(!in_array($statusFilter, ['active', 'all']), fn($q) => $q->where('status', $statusFilter))
            ->when($request->filled('type'), fn($q) => $q->where('order_type', $request->type))
            ->when($dateFilter, fn($q) => $q->whereDate('created_at', $dateFilter))
            ->when($request->filled('search'), fn($q) => $q->where('id', 'like', "%{$request->search}%")
                ->orWhere('customer_name', 'like', "%{$request->search}%"))
            ->latest()
            ->get();

        return view('staff.manage-orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order): RedirectResponse
    {
        $this->authorizeStaff();

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:pending,confirmed,preparing,ready,completed,cancelled'],
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Order status updated successfully.');
    }

    public function menu(Request $request): View
    {
        $this->authorizeStaff();

        $menuItems = MenuItem::when($request->filled('search'), function ($q) use ($request) {
            $q->where('name', 'like', "%{$request->search}%")
                ->orWhere('category', 'like', "%{$request->search}%");
        })->latest()->get();

        return view('staff.manage-menu', compact('menuItems'));
    }

    public function storeMenuItem(Request $request): RedirectResponse
    {
        $this->authorizeStaff();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'item' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/menu-image'), $filename);
            $validated['image_path'] = 'menu-images/' . $filename;
        }

        MenuItem::create($validated);

        return back()->with('success', 'Menu item added successfully.');
    }

    public function updateMenuItem(Request $request, MenuItem $menuItem): RedirectResponse
    {
        $this->authorizeStaff();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'item' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/menu-image'), $filename);
            $validated['image_path'] = 'menu-images/' . $filename;
        }

        $menuItem->update($validated);

        return back()->with('success', 'Menu item updated successfully.');
    }

    public function toggleMenuAvailability(MenuItem $menuItem): RedirectResponse
    {
        $this->authorizeStaff();

        $menuItem->update(['is_available' => !$menuItem->is_available]);

        return back()->with('success', 'Menu item availability toggled.');
    }

    public function destroyMenuItem(MenuItem $menuItem): RedirectResponse
    {
        $this->authorizeStaff();

        if ($menuItem->image_path) {
            $filePath = public_path('assets/images/menu-image/' . basename($menuItem->image_path));
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $menuItem->delete();

        return back()->with('success', 'Menu item deleted successfully.');
    }

    public function tables(): View
    {
        $this->authorizeStaff();

        $tables = Table::orderBy('table_number')->get();
        $existingNumbers = $tables->pluck('table_number')->toArray(); // e.g. [1,3,5]

        return view('staff.manage-tables', compact('tables', 'existingNumbers'));
    }
    public function storeTable(Request $request): RedirectResponse
    {
        $this->authorizeStaff();

        $validated = $request->validate([
            'table_number' => ['required', 'integer', 'min:1', 'max:30', 'unique:tables,table_number'],
        ]);
        $validated['capacity'] = 4;

        Table::create($validated);

        return back()->with('success', 'Table added successfully.');
    }

    public function destroyTable(Table $table): RedirectResponse
    {
        $this->authorizeStaff();

        $table->delete();

        return back()->with('success', 'Table deleted successfully.');
    }

    public function downloadQr(Request $request, int $table)
    {
        $this->authorizeStaff();

        $host = $request->getHost();
        $port = $request->getPort();

        if (in_array($host, ['127.0.0.1', 'localhost'])) {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                exec('ipconfig', $output);
                foreach ($output as $line) {
                    if (preg_match('/IPv4 Address.*: (192\.168\.\d+\.\d+)/', $line, $matches)) {
                        $host = $matches[1];
                        if (!str_ends_with($host, '.1'))
                            break;
                    }
                }
            } else {
                $host = trim(exec("hostname -I | awk '{print $1}'")) ?: $host;
            }
        }

        $qrOrderUrl = "http://{$host}:{$port}/customer/qr-order?table={$table}";
        $qrApiUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($qrOrderUrl);

        $imageData = file_get_contents($qrApiUrl);

        return response($imageData, 200)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', "attachment; filename=\"Table_{$table}_QR.png\"");
    }

    public function closeTable(int $tableNumber): RedirectResponse
    {
        $this->authorizeStaff();

        $count = Order::where('table_number', $tableNumber)
            ->whereIn('status', ['pending', 'confirmed', 'preparing', 'ready'])
            ->update(['status' => 'completed']);

        return back()->with('success', "Table {$tableNumber} closed — {$count} order(s) marked as completed.");
    }

    public function users(): View
    {
        $this->authorizeStaff();

        $users = User::latest()->get();

        return view('staff.manage-users', compact('users'));
    }

    public function storeUser(Request $request): RedirectResponse
    {
        $this->authorizeStaff();

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'in:customer,staff,admin'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // If current user is staff, only allow creating customer accounts
        if (Auth::user()->role === 'staff') {
            $validated['role'] = 'customer';
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = true;
        $validated['phone'] = $validated['phone'] ?? '';

        User::create($validated);

        return back()->with('success', 'User created successfully.');
    }

    public function updateUser(Request $request, User $user): RedirectResponse
    {
        $this->authorizeStaff();

        // Staff can only manage customer accounts
        if (Auth::user()->role === 'staff') {
            if ($user->role !== 'customer') {
                return back()->with('error', 'You are only authorized to manage customer accounts.');
            }
            // Ensure the role is not changed to something else
            if ($request->input('role') !== 'customer') {
                return back()->with('error', 'You cannot change the role of a customer.');
            }
        }

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'in:customer,staff,admin'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Force role for staff (safety)
        if (Auth::user()->role === 'staff') {
            $validated['role'] = 'customer';
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['phone'] = $validated['phone'] ?? '';

        $user->update($validated);

        return back()->with('success', 'User updated successfully.');
    }

    public function destroyUser(User $user): RedirectResponse
    {
        $this->authorizeStaff();

        if (Auth::user()->role === 'staff' && $user->role !== 'customer') {
            return back()->with('error', 'You are only authorized to manage customer accounts.');
        }

        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    public function toggleUserStatus(User $user): RedirectResponse
    {
        $this->authorizeStaff();

        if (Auth::user()->role === 'staff' && $user->role !== 'customer') {
            return back()->with('error', 'You are only authorized to manage customer accounts.');
        }

        // Prevent admins from deactivating themselves
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot deactivate your own account.');
        }

        $user->update(['is_active' => !$user->is_active]);

        return back()->with('success', 'User status updated successfully.');
    }

    public function reports(Request $request): View
    {
        $this->authorizeStaff();

        // Summary stats for all time
        $periodOrders = Order::count();
        $periodRevenue = Order::sum('total');

        // Today & month always shown
        $dailyOrders = Order::whereDate('created_at', today())->count();
        $dailyRevenue = Order::whereDate('created_at', today())->sum('total');
        $monthlyOrders = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->count();
        $monthlyRevenue = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->sum('total');

        // Order type breakdown for all time
        $typeBreakdown = Order::selectRaw('order_type, COUNT(*) as count, SUM(total) as revenue')
            ->groupBy('order_type')
            ->get()
            ->keyBy('order_type');

        // Last 7 days chart data
        $dailyLabels = [];
        $dailyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dailyLabels[] = $date->format('M d');
            $dailyData[] = (float) Order::whereDate('created_at', $date)->sum('total');
        }

        // Monthly chart data
        $monthlyLabels = [];
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyLabels[] = Carbon::create(date('Y'), $i, 1)->format('M');
            $monthlyData[] = (float) Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)
                ->sum('total');
        }

        // Top items for all time
        $topItems = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->select(
                'order_items.item_name',
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.line_total) as total_revenue')
            )
            ->groupBy('order_items.item_name')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        return view('staff.reports', compact(
            'periodOrders',
            'periodRevenue',
            'dailyOrders',
            'dailyRevenue',
            'monthlyOrders',
            'monthlyRevenue',
            'typeBreakdown',
            'dailyLabels',
            'dailyData',
            'monthlyLabels',
            'monthlyData',
            'topItems'
        ));
    }

    public function exportReport(Request $request)
    {
        $this->authorizeStaff();

        $dailyOrders = Order::whereDate('created_at', today())->count();
        $dailyRevenue = Order::whereDate('created_at', today())->sum('total');
        $monthlyOrders = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->count();
        $monthlyRevenue = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->sum('total');

        $periodOrders = Order::count();
        $periodRevenue = Order::sum('total');

        // $typeBreakdown = Order::whereBetween('created_at', [$fromDate, $toDate])
        //     ->selectRaw('order_type, COUNT(*) as count, SUM(total) as revenue')
        //     ->groupBy('order_type')
        //     ->get()
        //     ->keyBy('order_type');

        $topItems = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->select(
                'order_items.item_name',
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.line_total) as total_revenue')
            )
            ->groupBy('order_items.item_name')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        // Last 7 days chart
        $dailyLabels = [];
        $dailyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dailyLabels[] = $date->format('M d');
            $dailyData[] = (float) Order::whereDate('created_at', $date)->sum('total');
        }

        // Monthly chart
        $monthlyLabels = [];
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyLabels[] = Carbon::create(date('Y'), $i, 1)->format('M');
            $monthlyData[] = (float) Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)->sum('total');
        }

        $dailyChartUrl = 'https://quickchart.io/chart?w=600&h=250&c=' . urlencode(json_encode([
            'type' => 'bar',
            'data' => [
                'labels' => $dailyLabels,
                'datasets' => [
                    [
                        'label' => 'Revenue (RM)',
                        'data' => $dailyData,
                        'backgroundColor' => 'rgba(192,57,43,0.75)',
                    ]
                ],
            ],
            'options' => ['plugins' => ['legend' => ['display' => false]]],
        ]));

        $monthlyChartUrl = 'https://quickchart.io/chart?w=600&h=250&c=' . urlencode(json_encode([
            'type' => 'bar',
            'data' => [
                'labels' => $monthlyLabels,
                'datasets' => [
                    [
                        'label' => 'Revenue (RM)',
                        'data' => $monthlyData,
                        'backgroundColor' => 'rgba(39,174,96,0.75)',
                    ]
                ],
            ],
            'options' => ['plugins' => ['legend' => ['display' => false]]],
        ]));

        $pdf = Pdf::loadView('staff.reports-pdf', compact(
            'dailyOrders',
            'dailyRevenue',
            'monthlyOrders',
            'monthlyRevenue',
            'periodOrders',
            'periodRevenue',
            'typeBreakdown',
            'topItems',
            'dailyLabels',
            'dailyData',
            'monthlyLabels',
            'monthlyData',
            'dailyChartUrl',
            'monthlyChartUrl'
        ));

        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['isRemoteEnabled' => true]);

        return $pdf->download('sales_report_all_time.pdf');
    }
}
