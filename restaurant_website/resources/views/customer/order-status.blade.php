@extends('layouts.frontend')

@section('title', 'Order Status - Restoran SUP TULANG ZZ')

@section('styles')
    @include('customer.partials.account-styles')
@endsection

@section('content')
<main class="order-status-page">
    <div class="container">
        <div class="order-status-header">
            <h1><i class="fas fa-search"></i> Track Your Order</h1>
            <p>Enter your Order ID to check the current status</p>
        </div>

        <div class="order-search-box">
            <div class="input-wrapper">
                <i class="fas fa-receipt"></i>
                <input type="text" id="orderIdInput" placeholder="Enter Order ID (e.g. 12345)" value="{{ request('order_id') }}">
            </div>
            <button class="btn-search-order" id="btnSearchOrder"><i class="fas fa-search"></i> Track</button>
        </div>

        <div class="status-result" id="statusResult" style="display:none;">
            <div class="status-card">
                <div class="status-card-header">
                    <div>
                        <h2>Order <span id="displayOrderId"></span></h2>
                        <p id="displayOrderDate"></p>
                    </div>
                    <span class="status-badge" id="displayStatusBadge"></span>
                </div>
                <div class="order-progress">
                    <div class="progress-step" id="step-pending"><div class="step-icon"><i class="fas fa-receipt"></i></div><div class="step-label">Placed</div></div>
                    <div class="progress-line" id="line-1"></div>
                    <div class="progress-step" id="step-confirmed"><div class="step-icon"><i class="fas fa-check"></i></div><div class="step-label">Confirmed</div></div>
                    <div class="progress-line" id="line-2"></div>
                    <div class="progress-step" id="step-preparing"><div class="step-icon"><i class="fas fa-fire"></i></div><div class="step-label">Preparing</div></div>
                    <div class="progress-line" id="line-3"></div>
                    <div class="progress-step" id="step-ready"><div class="step-icon"><i class="fas fa-bell"></i></div><div class="step-label">Ready</div></div>
                    <div class="progress-line" id="line-4"></div>
                    <div class="progress-step" id="step-completed"><div class="step-icon"><i class="fas fa-check-double"></i></div><div class="step-label">Done</div></div>
                </div>
                <div class="status-footer">
                    <div class="status-info-row">
                        <span><i class="fas fa-user"></i> <span id="displayCustName"></span></span>
                        <span><i class="fas fa-concierge-bell"></i> <span id="displayOrderType"></span></span>
                        <span><i class="fas fa-wallet"></i> Total: <strong id="displayTotal"></strong></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="status-not-found" id="statusNotFound" style="display:none;">
            <i class="fas fa-search"></i>
            <h3>Order Not Found</h3>
            <p>We could not find an order with that ID. Please check and try again.</p>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('btnSearchOrder');
        const input = document.getElementById('orderIdInput');
        btn.addEventListener('click', searchOrder);
        input.addEventListener('keypress', e => { if (e.key === 'Enter') searchOrder(); });
        if (input.value) searchOrder();

        function searchOrder() {
            const orderId = input.value.trim();
            if (!orderId) { input.focus(); return; }
            fetch(`{{ route('api.orders.status') }}?order_id=${encodeURIComponent(orderId)}`)
                .then(r => r.json())
                .then(data => data.success ? showStatus(data.order) : showNotFound())
                .catch(showNotFound);
        }

        function showStatus(order) {
            document.getElementById('statusNotFound').style.display = 'none';
            document.getElementById('statusResult').style.display = 'block';
            document.getElementById('displayOrderId').textContent = '#' + order.id;
            document.getElementById('displayOrderDate').textContent = order.created_at;
            document.getElementById('displayCustName').textContent = order.customer_name;
            document.getElementById('displayOrderType').textContent = order.order_type;
            document.getElementById('displayTotal').textContent = 'RM ' + parseFloat(order.total).toFixed(2);
            const badge = document.getElementById('displayStatusBadge');
            badge.textContent = order.status;
            badge.className = 'status-badge status-' + order.status.toLowerCase().replace(' ', '-');
            updateSteps(order.status);
        }

        function showNotFound() {
            document.getElementById('statusResult').style.display = 'none';
            document.getElementById('statusNotFound').style.display = 'block';
        }

        function updateSteps(status) {
            const steps = ['pending','confirmed','preparing','ready','completed'];
            const idx = steps.indexOf(status.toLowerCase());
            steps.forEach((s, i) => {
                const el = document.getElementById('step-' + s);
                const line = document.getElementById('line-' + (i + 1));
                el.classList.remove('step-done', 'step-active');
                if (line) line.classList.remove('line-done');
                if (i <= idx) el.classList.add('step-done');
                if (i === idx) el.classList.add('step-active');
                if (line && i < idx) line.classList.add('line-done');
            });
        }
    });
</script>
@endsection
