<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    // Step 1: Show email form
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    // Step 1: Send OTP to email
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store OTP in cache for 10 minutes
        Cache::put('otp_' . $request->email, $otp, now()->addMinutes(10));
        Cache::put('otp_email_' . $request->email, $request->email, now()->addMinutes(10));

        Mail::to($request->email)->send(new OtpMail($otp));

        session(['email' => $request->email]);

        return redirect()->route('password.otp');
    }

    // Step 2: Show OTP form
    public function showOtp(): View|RedirectResponse
    {
        if (!session('email')) {
            return redirect()->route('password.request');
        }
        return view('auth.verify-otp', ['email' => session('email')]);
    }

    // Step 2: Verify OTP
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp'   => ['required', 'digits:6'],
        ]);

        $cachedOtp = Cache::get('otp_' . $request->email);

        if (!$cachedOtp || $cachedOtp !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.'])->withInput();
        }

        // OTP verified — store email in session for password reset
        Cache::forget('otp_' . $request->email);
        session(['reset_email' => $request->email]);

        return redirect()->route('password.new');
    }

    // Step 3: Show new password form
    public function showReset(): View|RedirectResponse
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request')->withErrors(['email' => 'Session expired. Please try again.']);
        }
        return view('auth.reset-password-new');
    }

    // Step 3: Reset password
    public function resetPassword(Request $request): RedirectResponse
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request')->withErrors(['email' => 'Session expired. Please try again.']);
        }

        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::where('email', session('reset_email'))->first();
        $user->forceFill(['password' => Hash::make($request->password)])->save();

        session()->forget('reset_email');

        return redirect()->route('login')->with('status', 'Password reset successfully! You can now log in.');
    }
}
