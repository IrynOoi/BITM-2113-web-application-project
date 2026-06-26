<!-- login.php -->
<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
if (isset($_SESSION['user_id'])) {
    $role = $_SESSION['user_role'] ?? 'customer';
    if ($role === 'admin' || $role === 'staff') {
        header('Location: admin/dashboard.php');
    } else {
        header('Location: customer/dashboard.php');
    }
    exit;
}
$errors = [
    'invalid' => 'Incorrect email or password. Please try again.',
    'inactive' => 'Your account has been deactivated. Contact us.',
    'db' => 'Server error. Please try again later.',
    'required' => 'Email and password are required.',
];
$errorMsg = isset($_GET['error']) ? ($errors[$_GET['error']] ?? '') : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
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

        .role-hint {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.82rem;
            color: #856404;
            margin-bottom: 20px;
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

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .checkbox-label input[type="checkbox"] {
            accent-color: #c0392b;
            width: 15px;
            height: 15px;
        }

        .forgot-link {
            font-size: 0.85rem;
            color: #c0392b;
            text-decoration: none;
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
</head>

<body>
    <?php include '../includes/header.php'; ?>

    <main class="auth-page">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <img src="../assets/images/Logo.jpeg" alt="Logo" class="auth-logo">
                    <h2>Welcome Back!</h2>
                    <p>Login to place orders and track your meals</p>
                </div>

                <div class="role-hint">
                    <i class="fas fa-info-circle"></i>
                    <span>Staff members: use your assigned staff credentials</span>
                </div>

                <?php if ($errorMsg): ?>
                    <div class="auth-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?= htmlspecialchars($errorMsg) ?></span>
                    </div>
                <?php endif; ?>

                <form class="auth-form" id="loginForm" method="POST" action="../api/auth.php">
                    <input type="hidden" name="action" value="login">

                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" placeholder="your@email.com" required>
                        </div>
                        <span class="error-message" id="emailError"></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="Enter your password"
                                required>
                            <button type="button" class="toggle-password" id="togglePwd"><i
                                    class="fas fa-eye"></i></button>
                        </div>
                        <span class="error-message" id="passwordError"></span>
                    </div>

                    <div class="form-group remember-row">
                        <label class="checkbox-label">
                            <input type="checkbox" name="rememberMe">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot-link">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn-auth">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </form>

                <div class="auth-footer">
                    <p>Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
    </main>

    <script src="../assets/js/validation.js"></script>
    <script>
        const btn = document.getElementById('togglePwd');
        const inp = document.getElementById('password');
        if (btn && inp) btn.addEventListener('click', function () {
            const show = inp.type === 'password';
            inp.type = show ? 'text' : 'password';
            this.querySelector('i').className = show ? 'fas fa-eye-slash' : 'fas fa-eye';
        });
    </script>

    <?php include '../includes/footer.php'; ?>
</body>

</html>