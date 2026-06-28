<?php
// <!-- PageController.php -->
namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'fullName' => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'max:255'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'subject'  => ['required', 'string', 'max:100'],
            'message'  => ['required', 'string', 'min:10'],
        ]);

        Mail::to('noreply@suptulangzz.com')->send(new ContactMail(
            senderName:  $validated['fullName'],
            senderEmail: $validated['email'],
            senderPhone: $validated['phone'] ?? '',
            topic:       $validated['subject'],
            messageBody: $validated['message'],
        ));

        return response()->json(['success' => true]);
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
