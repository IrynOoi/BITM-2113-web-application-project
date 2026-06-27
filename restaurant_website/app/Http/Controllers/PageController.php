<?php
// <!-- PageController.php -->
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function menu()
    {
        $menuItems = \App\Models\MenuItem::where('is_available', 1)->get();
        return view('menu', compact('menuItems'));
    }

    public function newsEvents()
    {
        return view('news-events');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }
}
