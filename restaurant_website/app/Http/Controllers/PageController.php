<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        return view('home');
    }

    public function about() {
        return view('about');
    }

    public function contact() {
        return view('contact');
    }

    public function menu() {
        return view('menu');
    }

    public function newsEvents() {
        return view('news-events');
    }

    public function login() {
        return view('auth.login');
    }

    public function register() {
        return view('auth.register');
    }
}
