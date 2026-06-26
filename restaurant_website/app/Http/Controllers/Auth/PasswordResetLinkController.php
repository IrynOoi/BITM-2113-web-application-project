<?php
// <!-- app/Http/Controllers/Auth/PasswordResetLinkController.php -->
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::where('email', $request->email)->first();
        $user->forceFill([
            'password' => Hash::make($request->password)
        ])->save();

        return redirect()->route('login')->with('status', 'Password reset successfully! You can now log in.');
    }
}
