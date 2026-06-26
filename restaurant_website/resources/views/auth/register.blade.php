<!-- register.blade.php -->
@extends('layouts.frontend')

@section('title', 'Register - Restoran SUP TULANG ZZ')

@section('styles')
    <style>
        .auth-page {
            min-height: calc(100vh - 120px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px 80px;
            background: linear-gradient(135deg, #fdf6f0 0%, #fce8e6 100%);
        }

        .auth-container {
            width: 100%;
            max-width: 440px;
        }

        .auth-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px 36px;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.13);
            border: 1px solid #f0ebe4;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .auth-logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 0 auto 14px;
            border: 3px solid #c0392b;
        }

        .auth-header h2 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #2c3e50;
            margin: 0 0 6px;
        }

        .auth-header p {
            color: #777;
            font-size: 0.875rem;
            margin: 0;
        }

        .auth-error {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fde8e8;
            border: 1px solid #f5c6c6;
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 0.875rem;
            color: #c0392b;
            margin-bottom: 16px;
        }

        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .required {
            color: #c0392b;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper>i:first-child {
            position: absolute;
            left: 14px;
            color: #999;
            font-size: 0.875rem;
            pointer-events: none;
        }

        .input-wrapper input {
            width: 100%;
            padding: 11px 44px 11px 40px;
            border: 2px solid #e8e0d8;
            border-radius: 8px;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.25s;
            font-family: inherit;
        }

        .input-wrapper input:focus {
            border-color: #c0392b;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            color: #999;
            font-size: 0.875rem;
            cursor: pointer;
            border: none;
            background: none;
        }

        .error-message {
            font-size: 0.78rem;
            color: #e74c3c;
            display: none;
        }

        .btn-auth {
            padding: 13px;
            background: #c0392b;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: background 0.25s, transform 0.2s;
            font-family: inherit;
            margin-top: 4px;
        }

        .btn-auth:hover {
            background: #96281b;
            transform: translateY(-2px);
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.875rem;
            color: #777;
        }

        .auth-footer a {
            color: #c0392b;
            font-weight: 600;
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <main class="auth-page">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <img src="{{ asset('assets/images/Logo.jpeg') }}" alt="Logo" class="auth-logo">
                    <h2>Create Account</h2>
                    <p>Join us to order your favorite meals</p>
                </div>

                @if($errors->any())
                    <div class="auth-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form class="auth-form" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="fullName">Full Name <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" id="fullName" name="fullName" value="{{ old('fullName') }}"
                                placeholder="Enter your full name" required autofocus autocomplete="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="your@email.com" required autocomplete="username">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-phone"></i>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="0123456789"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password"
                                placeholder="Create a password (min 8 chars)" required autocomplete="new-password">
                            <button type="button" class="toggle-password" id="togglePwd"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Confirm your password" required autocomplete="new-password">
                            <button type="button" class="toggle-password" id="toggleConfirmPwd"><i
                                    class="fas fa-eye"></i></button>
                        </div>
                    </div>

                    <button type="submit" class="btn-auth">
                        <i class="fas fa-user-plus"></i> Register
                    </button>
                </form>

                <div class="auth-footer">
                    <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        function togglePassword(btnId, inpId) {
            const btn = document.getElementById(btnId);
            const inp = document.getElementById(inpId);
            if (btn && inp) btn.addEventListener('click', function () {
                const show = inp.type === 'password';
                inp.type = show ? 'text' : 'password';
                this.querySelector('i').className = show ? 'fas fa-eye-slash' : 'fas fa-eye';
            });
        }
        togglePassword('togglePwd', 'password');
        togglePassword('toggleConfirmPwd', 'password_confirmation');
    </script>
@endsection