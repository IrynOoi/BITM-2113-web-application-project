<!-- account-styles.blade.php -->
<style>
    .dashboard-page,
    .order-status-page {
        padding: 36px 0 60px;
    }

    .dashboard-layout {
        display: grid;
        grid-template-columns: 240px 1fr;
        gap: 24px;
        align-items: start;
    }

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

    .sidebar-nav a,
    .sidebar-nav button {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        padding: 11px 18px;
        font-size: 0.875rem;
        font-weight: 500;
        color: #555;
        text-decoration: none;
        border: 0;
        border-left: 3px solid transparent;
        background: transparent;
        cursor: pointer;
        transition: all 0.18s;
        font-family: inherit;
    }

    .sidebar-nav a i,
    .sidebar-nav button i {
        width: 16px;
        color: #c0392b;
        font-size: 0.875rem;
    }

    .sidebar-nav a:hover,
    .sidebar-nav button:hover {
        background: #fdf6f0;
        color: #c0392b;
    }

    .sidebar-nav a.active {
        background: #fdf0ef;
        color: #c0392b;
        font-weight: 700;
        border-left-color: #c0392b;
    }

    .sidebar-nav .logout-form {
        margin: 4px 0 0;
        border-top: 1px solid #f5f0ea;
    }

    .sidebar-nav .logout-form button {
        color: #aaa;
    }

    .dashboard-main {
        min-width: 0;
    }

    .dashboard-header {
        margin-bottom: 24px;
    }

    .dashboard-header h1,
    .order-status-header h1 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #2c3e50;
        margin-bottom: 4px;
    }

    .dashboard-header p,
    .order-status-header p {
        color: #999;
        font-size: 0.875rem;
    }

    .alert-success,
    .alert-error {
        display: flex;
        align-items: center;
        gap: 10px;
        border-radius: 10px;
        padding: 13px 16px;
        font-size: 0.875rem;
        margin-bottom: 20px;
    }

    .alert-success {
        background: #d4edda;
        border: 1px solid #b8dfc4;
        color: #155724;
    }

    .alert-error {
        background: #fde8e8;
        border: 1px solid #f5c6c6;
        color: #c0392b;
    }

    .profile-card,
    .history-filters,
    .orders-table-wrapper,
    .status-card {
        background: #fff;
        border: 1px solid #f0ebe4;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
    }

    .profile-card {
        border-radius: 16px;
        padding: 28px;
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
    .input-wrapper textarea,
    .input-wrapper select {
        width: 100%;
        padding: 10px 14px 10px 38px;
        border: 2px solid #e8e0d8;
        border-radius: 10px;
        font-size: 0.875rem;
        font-family: inherit;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        color: #2c3e50;
        background: #fff;
    }

    .input-wrapper input:focus,
    .input-wrapper textarea:focus,
    .input-wrapper select:focus {
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

    .btn-save-profile,
    .btn-search-order,
    .btn-filter {
        padding: 11px 24px;
        background: linear-gradient(135deg, #c0392b, #e74c3c);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        font-family: inherit;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: all 0.2s;
        box-shadow: 0 3px 10px rgba(192, 57, 43, 0.3);
    }

    .btn-save-profile:hover,
    .btn-search-order:hover,
    .btn-filter:hover {
        transform: translateY(-2px);
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

    .history-filters {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        align-items: flex-end;
        margin-bottom: 20px;
        padding: 18px 20px;
        border-radius: 12px;
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
        color: #2c3e50;
    }

    .orders-table-wrapper {
        border-radius: 12px;
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

    .status-badge,
    .badge {
        display: inline-block;
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: capitalize;
    }

    .status-pending,
    .badge-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-confirmed,
    .badge-confirmed {
        background: #cce5ff;
        color: #004085;
    }

    .status-preparing,
    .badge-preparing {
        background: #fff3cd;
        color: #856404;
    }

    .status-ready,
    .badge-ready {
        background: #d1ecf1;
        color: #0c5460;
    }

    .status-completed,
    .badge-completed {
        background: #d4edda;
        color: #155724;
    }

    .status-cancelled,
    .badge-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .order-status-header {
        text-align: center;
        margin-bottom: 28px;
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

    .status-card {
        max-width: 680px;
        margin: 0 auto;
        border-radius: 16px;
        padding: 28px;
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
        margin: 0 4px 22px;
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

        .history-filters,
        .order-search-box {
            flex-direction: column;
        }

        .status-card {
            padding: 18px;
        }
    }
</style>