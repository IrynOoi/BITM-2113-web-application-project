<!-- profile.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
$success = isset($_GET['success']);
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <style>
        /* ── Page Layout ── */
        .dashboard-page {
            padding: 36px 0 60px;
        }

        .dashboard-layout {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 24px;
            align-items: start;
        }

        /* ── Sidebar ── */
        .dashboard-sidebar {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #f0ebe4;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 130px;
        }

        .sidebar-profile {
            padding: 24px 20px;
            text-align: center;
            background: linear-gradient(135deg, #c0392b 0%, #96281b 100%);
            color: #fff;
        }

        .sidebar-profile .profile-avatar {
            font-size: 3rem;
            margin-bottom: 8px;
            opacity: 0.9;
        }

        .sidebar-profile h3 {
            font-size: 0.95rem;
            font-weight: 700;
            margin: 0 0 3px;
        }

        .sidebar-profile p {
            font-size: 0.75rem;
            opacity: 0.75;
            margin: 0;
        }

        .sidebar-nav {
            padding: 8px 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 18px;
            font-size: 0.875rem;
            font-weight: 500;
            color: #555;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all 0.18s;
        }

        .sidebar-nav a i {
            width: 16px;
            color: #c0392b;
            font-size: 0.875rem;
        }

        .sidebar-nav a:hover {
            background: #fdf6f0;
            color: #c0392b;
        }

        .sidebar-nav a.active {
            background: #fdf0ef;
            color: #c0392b;
            font-weight: 700;
            border-left-color: #c0392b;
        }

        .sidebar-nav a.logout-link {
            color: #aaa;
            border-top: 1px solid #f5f0ea;
            margin-top: 4px;
        }

        .sidebar-nav a.logout-link:hover {
            color: #c0392b;
            background: #fdf0ef;
        }

        /* ── Main Content ── */
        .dashboard-main {
            min-width: 0;
        }

        .dashboard-header {
            margin-bottom: 24px;
        }

        .dashboard-header h1 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 4px;
        }

        .dashboard-header p {
            color: #999;
            font-size: 0.875rem;
        }

        /* ── Alert Banners ── */
        .alert-success {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #d4edda;
            border: 1px solid #b8dfc4;
            border-radius: 10px;
            padding: 13px 16px;
            color: #155724;
            font-size: 0.875rem;
            margin-bottom: 20px;
        }

        .alert-error {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fde8e8;
            border: 1px solid #f5c6c6;
            border-radius: 10px;
            padding: 13px 16px;
            color: #c0392b;
            font-size: 0.875rem;
            margin-bottom: 20px;
        }

        /* ── Profile Card ── */
        .profile-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            border: 1px solid #f0ebe4;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .profile-form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 0.82rem;
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
            left: 13px;
            color: #bbb;
            font-size: 0.85rem;
            pointer-events: none;
        }

        .input-wrapper input,
        .input-wrapper textarea {
            width: 100%;
            padding: 10px 14px 10px 38px;
            border: 2px solid #e8e0d8;
            border-radius: 10px;
            font-size: 0.875rem;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            color: #2c3e50;
        }

        .input-wrapper input:focus,
        .input-wrapper textarea:focus {
            border-color: #c0392b;
            box-shadow: 0 0 0 3px rgba(192, 57, 43, 0.08);
        }

        .readonly-input {
            background: #f8f5f2 !important;
            cursor: not-allowed;
            color: #aaa !important;
        }

        .field-note {
            font-size: 0.75rem;
            color: #bbb;
        }

        .profile-section-divider {
            position: relative;
            text-align: center;
            margin: 4px 0;
        }

        .profile-section-divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #f0ebe4;
        }

        .profile-section-divider span {
            position: relative;
            background: #fff;
            padding: 0 12px;
            font-size: 0.8rem;
            color: #bbb;
            font-weight: 500;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            padding-top: 4px;
        }

        .btn-save-profile {
            padding: 11px 28px;
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.9rem;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: all 0.2s;
            box-shadow: 0 3px 10px rgba(192, 57, 43, 0.3);
        }

        .btn-save-profile:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 14px rgba(192, 57, 43, 0.4);
        }

        .btn-cancel-profile {
            padding: 11px 22px;
            border: 2px solid #e8e0d8;
            border-radius: 10px;
            color: #999;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: all 0.2s;
        }

        .btn-cancel-profile:hover {
            border-color: #c0392b;
            color: #c0392b;
        }

        /* ── Order Status Page ── */
        .order-status-page {
            padding: 36px 0 60px;
        }

        .order-status-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .order-status-header h1 {
            font-size: 1.7rem;
            font-weight: 800;
            color: #2c3e50;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .order-status-header h1 i {
            color: #c0392b;
        }

        .order-status-header p {
            color: #999;
            margin-top: 6px;
        }

        .order-search-box {
            display: flex;
            gap: 10px;
            max-width: 500px;
            margin: 0 auto 40px;
        }

        .order-search-box .input-wrapper {
            flex: 1;
        }

        .order-search-box .input-wrapper input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 2px solid #e8e0d8;
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s;
        }

        .order-search-box .input-wrapper input:focus {
            border-color: #c0392b;
        }

        .order-search-box .input-wrapper i {
            position: absolute;
            left: 14px;
            color: #bbb;
            pointer-events: none;
        }

        .btn-search-order {
            padding: 12px 22px;
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.9rem;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            white-space: nowrap;
            transition: all 0.2s;
            box-shadow: 0 3px 10px rgba(192, 57, 43, 0.3);
        }

        .btn-search-order:hover {
            transform: translateY(-2px);
        }

        /* ── Status Card ── */
        .status-card {
            max-width: 680px;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            border: 1px solid #f0ebe4;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        .status-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .status-card-header h2 {
            font-size: 1.2rem;
            font-weight: 800;
            color: #2c3e50;
            margin: 0 0 4px;
        }

        .status-card-header p {
            font-size: 0.82rem;
            color: #aaa;
            margin: 0;
        }

        /* Status Badges */
        .status-badge {
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: capitalize;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-confirmed {
            background: #cce5ff;
            color: #004085;
        }

        .status-preparing {
            background: #fff3cd;
            color: #856404;
        }

        .status-ready {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        /* ── Progress Tracker ── */
        .order-progress {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
            overflow-x: auto;
            padding-bottom: 6px;
        }

        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            min-width: 58px;
        }

        .step-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f5f0ea;
            border: 2px solid #e8e0d8;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ccc;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .step-label {
            font-size: 0.7rem;
            color: #bbb;
            font-weight: 500;
            text-align: center;
        }

        .progress-step.step-done .step-icon {
            background: #c0392b;
            border-color: #c0392b;
            color: #fff;
        }

        .progress-step.step-done .step-label {
            color: #c0392b;
            font-weight: 600;
        }

        .progress-step.step-active .step-icon {
            box-shadow: 0 0 0 4px rgba(192, 57, 43, 0.2);
        }

        .progress-line {
            flex: 1;
            height: 2px;
            background: #e8e0d8;
            margin: 0 4px;
            margin-bottom: 22px;
            min-width: 20px;
            transition: background 0.3s;
        }

        .progress-line.line-done {
            background: #c0392b;
        }

        .status-footer {
            background: #fdf6f0;
            border-radius: 10px;
            padding: 14px 16px;
        }

        .status-info-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            font-size: 0.82rem;
            color: #777;
        }

        .status-info-row i {
            color: #c0392b;
            margin-right: 4px;
        }

        .status-not-found {
            text-align: center;
            padding: 60px 20px;
            color: #bbb;
            max-width: 400px;
            margin: 0 auto;
        }

        .status-not-found i {
            font-size: 3rem;
            margin-bottom: 14px;
            opacity: 0.25;
            display: block;
        }

        .status-not-found h3 {
            font-size: 1.2rem;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .status-not-found p {
            font-size: 0.875rem;
        }

        /* ── History Filters ── */
        .history-filters {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            align-items: flex-end;
            margin-bottom: 20px;
            background: #fff;
            padding: 18px 20px;
            border-radius: 12px;
            border: 1px solid #f0ebe4;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.04);
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .filter-group label {
            font-size: 0.78rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .filter-group select,
        .filter-group input[type="date"] {
            padding: 8px 12px;
            border: 2px solid #e8e0d8;
            border-radius: 8px;
            font-size: 0.85rem;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s;
            color: #2c3e50;
        }

        .filter-group select:focus,
        .filter-group input[type="date"]:focus {
            border-color: #c0392b;
        }

        .btn-filter {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 9px 20px;
            background: #c0392b;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s;
            align-self: flex-end;
        }

        .btn-filter:hover {
            background: #96281b;
        }

        /* ── Orders Table ── */
        .orders-table-wrapper {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #f0ebe4;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.04);
            overflow-x: auto;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .orders-table th {
            background: #fdf6f0;
            padding: 13px 16px;
            text-align: left;
            font-weight: 700;
            color: #2c3e50;
            border-bottom: 2px solid #f0ebe4;
            white-space: nowrap;
        }

        .orders-table td {
            padding: 13px 16px;
            border-bottom: 1px solid #f8f4f0;
            color: #555;
            vertical-align: middle;
        }

        .orders-table tbody tr:hover {
            background: #fdf9f6;
        }

        .orders-table tbody tr:last-child td {
            border-bottom: none;
        }

        .table-placeholder td {
            text-align: center;
            padding: 48px 20px;
            color: #bbb;
        }

        .table-placeholder i {
            font-size: 2.5rem;
            display: block;
            margin-bottom: 10px;
            opacity: 0.2;
        }

        .table-placeholder p {
            margin: 4px 0 0;
        }

        .table-placeholder a {
            color: #c0392b;
            font-weight: 600;
        }

        /* Pagination */
        .pagination {
            display: flex;
            gap: 6px;
            justify-content: center;
            margin-top: 20px;
        }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .dashboard-sidebar {
                position: static;
            }
        }

        @media (max-width: 540px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .history-filters {
                flex-direction: column;
            }

            .order-search-box {
                flex-direction: column;
            }

            .status-card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>
    <?php include '../../includes/header.php'; ?>

    <main class="dashboard-page">
        <div class="container">
            <div class="dashboard-layout">
                <aside class="dashboard-sidebar">
                    <div class="sidebar-profile">
                        <div class="profile-avatar"><i class="fas fa-user-circle"></i></div>
                        <h3><?= htmlspecialchars($_SESSION['user_name']) ?></h3>
                        <p><?= htmlspecialchars($_SESSION['user_email']) ?></p>
                    </div>
                    <nav class="sidebar-nav">
                        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        <a href="order-status.php"><i class="fas fa-receipt"></i> Order Status</a>
                        <a href="order-history.php"><i class="fas fa-history"></i> Order History</a>
                        <a href="profile.php" class="active"><i class="fas fa-user-edit"></i> Edit Profile</a>
                        <a href="../../api/auth.php?action=logout" class="logout-link"><i
                                class="fas fa-sign-out-alt"></i> Logout</a>
                    </nav>
                </aside>

                <div class="dashboard-main">
                    <div class="dashboard-header">
                        <h1>Edit Profile</h1>
                        <p>Update your personal information</p>
                    </div>

                    <?php if ($success): ?>
                        <div class="alert-success">
                            <i class="fas fa-check-circle"></i> Profile updated successfully!
                        </div>
                    <?php endif; ?>
                    <?php if ($error === 'wrong_pw'): ?>
                        <div class="alert-error">
                            <i class="fas fa-exclamation-circle"></i> Current password is incorrect.
                        </div>
                    <?php endif; ?>

                    <div class="profile-card">
                        <form class="profile-form" method="POST" action="../../api/auth.php">
                            <input type="hidden" name="action" value="update_profile">

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="fullName">Full Name <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="fullName" name="fullName"
                                            value="<?= htmlspecialchars($_SESSION['user_name']) ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-phone"></i>
                                        <input type="tel" id="phone" name="phone"
                                            value="<?= htmlspecialchars($_SESSION['user_phone'] ?? '') ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" value="<?= htmlspecialchars($_SESSION['user_email']) ?>"
                                        readonly class="readonly-input">
                                </div>
                                <small class="field-note">Email cannot be changed</small>
                            </div>

                            <div class="form-group">
                                <label for="address">Default Address</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <textarea id="address" name="address" rows="3"
                                        placeholder="Your default delivery address"></textarea>
                                </div>
                            </div>

                            <div class="profile-section-divider"><span>Change Password (optional)</span></div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="currentPassword">Current Password</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="currentPassword" name="currentPassword"
                                            placeholder="Enter current password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="newPassword" name="newPassword"
                                            placeholder="Min 8 characters">
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-save-profile">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                                <a href="dashboard.php" class="btn-cancel-profile">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>