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

        $orders = Order::with('user')->withCount('items')
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->when($request->filled('type'), fn($q) => $q->where('order_type', $request->type))
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
            $validated['image_path'] = $request->file('image')->store('menu-images', 'public');
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
            $validated['image_path'] = $request->file('image')->store('menu-images', 'public');
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

        // Alternatively, soft delete or just set is_available = false
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

    public function reports(): View
    {
        $this->authorizeStaff();

        $dailyOrders = Order::whereDate('created_at', today())->count();
        $dailyRevenue = Order::whereDate('created_at', today())->sum('total');

        $monthlyOrders = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->count();
        $monthlyRevenue = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->sum('total');

        // Daily Revenue (Last 7 Days)
        $dailyLabels = [];
        $dailyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dailyLabels[] = $date->format('M d');
            $dailyData[] = Order::whereDate('created_at', $date)->sum('total');
        }

        // Monthly Revenue (Current Year)
        $monthlyLabels = [];
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $month = Carbon::create(date('Y'), $i, 1);
            $monthlyLabels[] = $month->format('M');
            $monthlyData[] = Order::whereYear('created_at', date('Y'))
                                  ->whereMonth('created_at', $i)
                                  ->sum('total');
        }

        $dailyChartConfig = [
            'type' => 'bar',
            'data' => [
                'labels' => $dailyLabels,
                'datasets' => [[
                    'label' => 'Daily Revenue (RM)',
                    'data' => $dailyData,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.8)'
                ]]
            ],
            'options' => [
                'title' => ['display' => true, 'text' => 'Daily Revenue - Last 7 Days']
            ]
        ];
        
        $monthlyChartConfig = [
            'type' => 'bar',
            'data' => [
                'labels' => $monthlyLabels,
                'datasets' => [[
                    'label' => 'Monthly Revenue (RM)',
                    'data' => $monthlyData,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.8)'
                ]]
            ],
            'options' => [
                'title' => ['display' => true, 'text' => 'Monthly Revenue - ' . date('Y')]
            ]
        ];

        $dailyChartUrl = 'https://quickchart.io/chart?w=800&h=400&c=' . urlencode(json_encode($dailyChartConfig));
        $monthlyChartUrl = 'https://quickchart.io/chart?w=800&h=400&c=' . urlencode(json_encode($monthlyChartConfig));

        $topItems = DB::table('order_items')
            ->select('menu_item_id', 'item_name', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('menu_item_id', 'item_name')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        return view('staff.reports', compact(
            'dailyOrders', 'dailyRevenue', 'monthlyOrders', 'monthlyRevenue', 'topItems', 'dailyChartUrl', 'monthlyChartUrl'
        ));
    }

    public function exportReport()
    {
        $this->authorizeStaff();

        $dailyOrders = Order::whereDate('created_at', today())->count();
        $dailyRevenue = Order::whereDate('created_at', today())->sum('total');

        $weeklyOrders = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $weeklyRevenue = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total');

        // Daily Revenue (Last 7 Days)
        $dailyLabels = [];
        $dailyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dailyLabels[] = $date->format('M d');
            $dailyData[] = Order::whereDate('created_at', $date)->sum('total');
        }

        // Monthly Revenue (Current Year)
        $monthlyLabels = [];
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $month = Carbon::create(date('Y'), $i, 1);
            $monthlyLabels[] = $month->format('M');
            $monthlyData[] = Order::whereYear('created_at', date('Y'))
                                  ->whereMonth('created_at', $i)
                                  ->sum('total');
        }

        // Generate QuickChart URLs
        $dailyChartConfig = [
            'type' => 'bar',
            'data' => [
                'labels' => $dailyLabels,
                'datasets' => [[
                    'label' => 'Daily Revenue (RM)',
                    'data' => $dailyData,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.8)'
                ]]
            ],
            'options' => [
                'title' => ['display' => true, 'text' => 'Daily Revenue - Last 7 Days']
            ]
        ];
        
        $monthlyChartConfig = [
            'type' => 'bar',
            'data' => [
                'labels' => $monthlyLabels,
                'datasets' => [[
                    'label' => 'Monthly Revenue (RM)',
                    'data' => $monthlyData,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.8)'
                ]]
            ],
            'options' => [
                'title' => ['display' => true, 'text' => 'Monthly Revenue - ' . date('Y')]
            ]
        ];

        $dailyChartUrl = 'https://quickchart.io/chart?w=600&h=300&c=' . urlencode(json_encode($dailyChartConfig));
        $monthlyChartUrl = 'https://quickchart.io/chart?w=600&h=300&c=' . urlencode(json_encode($monthlyChartConfig));

        $pdf = Pdf::loadView('staff.reports-pdf', compact(
            'dailyOrders', 'dailyRevenue', 'weeklyOrders', 'weeklyRevenue',
            'dailyChartUrl', 'monthlyChartUrl'
        ));

        // Enable remote images for dompdf to load quickchart images
        $pdf->setOption(['isRemoteEnabled' => true]);

        return $pdf->download('sales_report_' . date('Y-m-d') . '.pdf');
    }
}
