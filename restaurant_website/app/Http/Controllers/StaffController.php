<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StaffController extends Controller
{
    private function authorizeStaff(): void
    {
        abort_unless(in_array(Auth::user()->role, ['admin', 'staff'], true), 403);
    }

    public function dashboard(): View
    {
        $this->authorizeStaff();

        $orders = Order::withCount('items')->latest()->take(5)->get();

        return view('staff.dashboard', compact('orders'));
    }

    public function orders(): View
    {
        $this->authorizeStaff();

        $orders = Order::withCount('items')->latest()->get();

        return view('staff.manage-orders', compact('orders'));
    }

    public function menu(): View
    {
        $this->authorizeStaff();

        return view('staff.manage-menu');
    }

    public function tables(): View
    {
        $this->authorizeStaff();

        return view('staff.manage-tables');
    }

    public function users(): View
    {
        $this->authorizeStaff();

        $users = User::latest()->get();

        return view('staff.manage-users', compact('users'));
    }
}
