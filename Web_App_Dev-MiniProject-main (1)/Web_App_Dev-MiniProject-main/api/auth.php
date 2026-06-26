<?php
// ============================================================
// auth.php — Authentication API
// Restoran SUP TULANG ZZ
// Database: restaurant_oms
// ============================================================

session_start();

// ── Database Connection ──────────────────────────────────────
$host   = 'localhost';
$dbname = 'restaurant_oms';
$user   = 'root';
$pass   = '';   // XAMPP default

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user, $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    // Redirect back with db error
    $ref = $_SERVER['HTTP_REFERER'] ?? '../pages/login.php';
    header('Location: ../pages/login.php?error=db');
    exit;
}

// ── Get action ───────────────────────────────────────────────
$action = $_POST['action'] ?? $_GET['action'] ?? '';

// ============================================================
// LOGIN
// ============================================================
if ($action === 'login') {

    $email    = trim($_POST['email']    ?? '');
    $password = $_POST['password']      ?? '';

    if (empty($email) || empty($password)) {
        header('Location: ../pages/login.php?error=required');
        exit;
    }

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? AND is_active = 1 LIMIT 1');
    $stmt->execute([$email]);
    $userData = $stmt->fetch();

    if (!$userData || !password_verify($password, $userData['password'])) {
        header('Location: ../pages/login.php?error=invalid');
        exit;
    }

    // ── Set session ──
    $_SESSION['user_id']    = $userData['id'];
    $_SESSION['user_name']  = $userData['full_name'];
    $_SESSION['user_email'] = $userData['email'];
    $_SESSION['user_role']  = $userData['role'];
    $_SESSION['user_phone'] = $userData['phone'];
    $_SESSION['user_address'] = $userData['address'] ?? '';

    // ── Redirect by role ──
    switch ($userData['role']) {

        case 'admin':
            header('Location: ../pages/staff/dashboard.php');
            break;
        default:
            header('Location: ../pages/customer/dashboard.php');
            break;
    }
    exit;
}

// ============================================================
// REGISTER
// ============================================================
if ($action === 'register') {

    $fullName = trim($_POST['fullName']         ?? '');
    $email    = trim($_POST['email']            ?? '');
    $phone    = trim($_POST['phone']            ?? '');
    $password = $_POST['password']              ?? '';
    $confirm  = $_POST['confirmPassword']       ?? '';

    // Validate
    if (empty($fullName) || strlen($fullName) < 2 ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        empty($phone) || strlen($password) < 8) {
        header('Location: ../pages/register.php?error=required');
        exit;
    }

    if ($password !== $confirm) {
        header('Location: ../pages/register.php?error=mismatch');
        exit;
    }

    // Validate Malaysian phone
    $cleanPhone = preg_replace('/[\s\-]/', '', $phone);
    if (!preg_match('/^(01[0-9])\d{7,8}$/', $cleanPhone)) {
        header('Location: ../pages/register.php?error=invalid_ph');
        exit;
    }

    // Check duplicate email
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        header('Location: ../pages/register.php?error=exists');
        exit;
    }

    // Insert user
    $hashed = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    $stmt = $pdo->prepare('
        INSERT INTO users (full_name, email, phone, password, role)
        VALUES (?, ?, ?, ?, "customer")
    ');
    $stmt->execute([$fullName, $email, $phone, $hashed]);
    $newId = $pdo->lastInsertId();

    // Auto-login
    $_SESSION['user_id']    = $newId;
    $_SESSION['user_name']  = $fullName;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_role']  = 'customer';
    $_SESSION['user_phone'] = $phone;

    header('Location: ../pages/customer/dashboard.php');
    exit;
}

// ============================================================
// LOGOUT
// ============================================================
if ($action === 'logout') {
    session_destroy();
    header('Location: ../pages/login.php');
    exit;
}

// ============================================================
// CHECK SESSION — returns JSON (called by JS fetch)
// ============================================================
if ($action === 'check_session') {
    header('Content-Type: application/json');
    if (isset($_SESSION['user_id'])) {
        echo json_encode([
            'success' => true,
            'user'    => [
                'id'    => $_SESSION['user_id'],
                'name'  => $_SESSION['user_name'],
                'email' => $_SESSION['user_email'],
                'role'  => $_SESSION['user_role'],
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Not logged in']);
    }
    exit;
}

// ============================================================
// UPDATE PROFILE — called from profile.php form
// ============================================================
if ($action === 'update_profile') {

    if (!isset($_SESSION['user_id'])) {
        header('Location: ../pages/login.php');
        exit;
    }

    $fullName    = trim($_POST['fullName']        ?? '');
    $phone       = trim($_POST['phone']           ?? '');
    $address     = trim($_POST['address']         ?? '');
    $currentPass = $_POST['currentPassword']      ?? '';
    $newPass     = $_POST['newPassword']          ?? '';

    if (!empty($newPass)) {
        if (strlen($newPass) < 8) {
            header('Location: ../pages/customer/profile.php?error=short_pw');
            exit;
        }
        $stmt = $pdo->prepare('SELECT password FROM users WHERE id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $row = $stmt->fetch();
        if (!$row || !password_verify($currentPass, $row['password'])) {
            header('Location: ../pages/customer/profile.php?error=wrong_pw');
            exit;
        }
        $hashed = password_hash($newPass, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $pdo->prepare('
            UPDATE users SET full_name=?, phone=?, address=?, password=?, updated_at=NOW()
            WHERE id=?
        ');
        $stmt->execute([$fullName, $phone, $address, $hashed, $_SESSION['user_id']]);
    } else {
        $stmt = $pdo->prepare('
            UPDATE users SET full_name=?, phone=?, address=?, updated_at=NOW()
            WHERE id=?
        ');
        $stmt->execute([$fullName, $phone, $address, $_SESSION['user_id']]);
    }

    $_SESSION['user_name']    = $fullName;
    $_SESSION['user_phone']   = $phone;
    $_SESSION['user_address'] = $address;
    header('Location: ../pages/customer/profile.php?success=1');
    exit;
}

// ── Unknown action ───────────────────────────────────────────
header('Location: ../pages/login.php');
exit;