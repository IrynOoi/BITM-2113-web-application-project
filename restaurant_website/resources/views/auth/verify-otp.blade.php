<!-- verify-otp.blade.php -->
@extends('layouts.frontend')

@section('title', 'Verify OTP - Restoran SUP TULANG ZZ')

@section('styles')
    <style>
        .auth-page { min-height: calc(100vh - 120px); display: flex; align-items: center; justify-content: center; padding: 40px 16px 80px; background: linear-gradient(135deg, #fdf6f0 0%, #fce8e6 100%); }
        .auth-container { width: 100%; max-width: 440px; }
        .auth-card { background: #fff; border-radius: 20px; padding: 40px 36px; box-shadow: 0 8px 40px rgba(0,0,0,0.13); border: 1px solid #f0ebe4; }
        .auth-header { text-align: center; margin-bottom: 24px; }
        .auth-logo { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; display: block; margin: 0 auto 14px; border: 3px solid #c0392b; }
        .auth-header h2 { font-size: 1.5rem; font-weight: 800; color: #2c3e50; margin: 0 0 6px; }
        .auth-header p { color: #777; font-size: 0.875rem; margin: 0; line-height: 1.5; }
        .auth-error { display: flex; align-items: center; gap: 8px; background: #fde8e8; border: 1px solid #f5c6c6; border-radius: 8px; padding: 12px 14px; font-size: 0.875rem; color: #c0392b; margin-bottom: 16px; }
        .auth-form { display: flex; flex-direction: column; gap: 16px; }
        .form-group { display: flex; flex-direction: column; gap: 5px; }
        .form-group label { font-size: 0.85rem; font-weight: 600; color: #2c3e50; }
        .required { color: #c0392b; }
        .input-wrapper { position: relative; display: flex; align-items: center; }
        .input-wrapper > i { position: absolute; left: 14px; color: #999; font-size: 0.875rem; pointer-events: none; }
        .input-wrapper input { width: 100%; padding: 11px 14px 11px 40px; border: 2px solid #e8e0d8; border-radius: 8px; font-size: 1.2rem; letter-spacing: 8px; text-align: center; outline: none; transition: border-color 0.25s; font-family: inherit; }
        .input-wrapper input:focus { border-color: #c0392b; }
        .btn-auth { padding: 13px; background: #c0392b; color: #fff; border: none; border-radius: 8px; font-weight: 700; font-size: 1rem; display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; transition: background 0.25s, transform 0.2s; font-family: inherit; margin-top: 10px; }
        .btn-auth:hover { background: #96281b; transform: translateY(-2px); }
        .auth-footer { text-align: center; margin-top: 20px; font-size: 0.875rem; color: #777; }
        .auth-footer a { color: #c0392b; font-weight: 600; text-decoration: none; }
        .otp-hint { text-align: center; font-size: 0.8rem; color: #999; margin-top: -8px; }
    </style>
@endsection

@section('content')
    <main class="auth-page">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <img src="{{ asset('assets/images/Logo.jpeg') }}" alt="Logo" class="auth-logo">
                    <h2>Enter OTP</h2>
                    <p>We've sent a 6-digit OTP to <strong>{{ session('email') ?? $email }}</strong>. Check your inbox.</p>
                </div>

                @if($errors->any())
                    <div class="auth-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form class="auth-form" method="POST" action="{{ route('password.otp.verify') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') ?? $email }}">

                    <div class="form-group">
                        <label for="otp">OTP Code <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-shield-alt"></i>
                            <input type="text" id="otp" name="otp" placeholder="000000" maxlength="6" required autofocus inputmode="numeric">
                        </div>
                        <p class="otp-hint">Valid for 10 minutes</p>
                    </div>

                    <button type="submit" class="btn-auth">
                        <i class="fas fa-check-circle"></i> Verify OTP
                    </button>
                </form>

                <div class="auth-footer">
                    <p>Didn't receive it? <a href="{{ route('password.request') }}">Resend OTP</a></p>
                </div>
            </div>
        </div>
    </main>
@endsection
