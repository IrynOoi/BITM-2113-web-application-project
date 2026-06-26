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
            'category' => ['required', 'in:main,drinks,dessert,snacks,soup'],
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
            'category' => ['required', 'in:main,drinks,dessert,snacks,soup'],
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
            'capacity' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

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

        $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        $validated['is_active'] = true;

        User::create($validated);

        return back()->with('success', 'User created successfully.');
    }

    public function toggleUserStatus(User $user): RedirectResponse
    {
        $this->authorizeStaff();

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

        $weeklyOrders = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $weeklyRevenue = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total');

        $topItems = DB::table('order_items')
            ->select('menu_item_id', 'item_name', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('menu_item_id', 'item_name')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        return view('staff.reports', compact('dailyOrders', 'dailyRevenue', 'weeklyOrders', 'weeklyRevenue', 'topItems'));
    }
}
