<!-- order-status.blade.php -->
@extends(request()->has('qr') ? 'layouts.qr' : 'layouts.frontend')

@section('title', 'Order Status - Restoran SUP TULANG ZZ')

@section('styles')
    @include('customer.partials.account-styles')
    <style>
        .table-orders-header {
            text-align: center;
            margin-bottom: 28px;
        }
        .table-orders-header h1 {
            font-size: 1.6rem;
            font-weight: 800;
            color: #2c3e50;
        }
        .table-orders-header p {
            color: #888;
            margin-top: 6px;
        }
        .table-badge {
            display: inline-block;
            background: #c0392b;
            color: #fff;
            font-size: 0.85rem;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 10px;
        }
        .order-cards-list {
            display: flex;
            flex-direction: column;
            gap: 18px;
            max-width: 680px;
            margin: 0 auto;
        }
        .order-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #f0ebe4;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .order-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 20px;
            background: #fdf8f7;
            border-bottom: 1px solid #f0ebe4;
        }
        .order-card-header h3 {
            font-size: 1rem;
            font-weight: 700;
            color: #2c3e50;
        }
        .order-card-header small {
            color: #aaa;
            font-size: 0.8rem;
        }
        .order-card-body {
            padding: 16px 20px;
        }
        .order-item-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.875rem;
            padding: 5px 0;
            color: #444;
            border-bottom: 1px dashed #f0ebe4;
        }
        .order-item-row:last-child { border-bottom: none; }
        .order-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 20px;
            background: #fdf8f7;
            border-top: 1px solid #f0ebe4;
            font-weight: 700;
            font-size: 0.9rem;
            color: #2c3e50;
        }
        .grand-total-card {
            max-width: 680px;
            margin: 18px auto 0;
            background: #2c3e50;
            color: #fff;
            border-radius: 14px;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.1rem;
            font-weight: 800;
        }
        .refresh-btn {
            display: block;
            margin: 20px auto 0;
            background: transparent;
            border: 2px solid #c0392b;
            color: #c0392b;
            padding: 9px 22px;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
        }
        .refresh-btn:hover { background: #fdf0ef; }
        .no-active-orders {
            text-align: center;
            padding: 40px 20px;
            color: #aaa;
        }
        .no-active-orders i { font-size: 2.5rem; margin-bottom: 12px; }
        /* progress steps reused */
        .order-progress {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            padding: 14px 20px 6px;
            flex-wrap: nowrap;
            overflow-x: auto;
        }
        .progress-step { display: flex; flex-direction: column; align-items: center; gap: 4px; min-width: 52px; }
        .step-icon { width: 34px; height: 34px; border-radius: 50%; background: #eee; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; color: #bbb; }
        .step-label { font-size: 0.65rem; color: #bbb; text-align: center; }
        .progress-line { flex: 1; height: 2px; background: #eee; min-width: 18px; }
        .step-done .step-icon { background: #27ae60; color: #fff; }
        .step-done .step-label { color: #27ae60; font-weight: 600; }
        .step-active .step-icon { background: #c0392b; color: #fff; box-shadow: 0 0 0 4px rgba(192,57,43,0.15); }
        .step-active .step-label { color: #c0392b; font-weight: 700; }
        .line-done { background: #27ae60; }
    </style>
@endsection

@section('content')
    <main class="order-status-page">
        <div class="container">

            @if(request()->has('qr') && request()->has('table'))
                {{-- QR TABLE MODE: show all active orders for this table --}}
                <div class="table-orders-header">
                    <span class="table-badge"><i class="fas fa-chair"></i> Table {{ request('table') }}</span>
                    <h1>Your Orders</h1>
                    <p>All active orders for your table</p>
                </div>

                <div id="tableOrdersContainer">
                    <div style="text-align:center; padding:30px; color:#aaa;">
                        <i class="fas fa-spinner fa-spin" style="font-size:1.8rem;"></i>
                        <p style="margin-top:10px;">Loading orders...</p>
                    </div>
                </div>

                <div style="display:flex; gap:10px; justify-content:center; margin-top:20px; flex-wrap:wrap;">
                    <button class="refresh-btn" style="margin:0;" onclick="loadTableOrders()">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                    <a href="{{ url('/customer/qr-order') }}?table={{ request('table') }}&pax={{ request('pax', 1) }}"
                       style="display:inline-flex; align-items:center; gap:6px; background:#c0392b; color:#fff; padding:9px 22px; border-radius:10px; font-size:0.875rem; font-weight:600; text-decoration:none;">
                        <i class="fas fa-plus"></i> Order More
                    </a>
                </div>

            @else
                {{-- NORMAL MODE: search by order ID --}}
                <div class="order-status-header">
                    <h1><i class="fas fa-search"></i> Track Your Order</h1>
                    <p>Enter your Order ID to check the current status</p>
                </div>

                <div class="order-search-box">
                    <div class="input-wrapper">
                        <i class="fas fa-receipt"></i>
                        <input type="text" id="orderIdInput" placeholder="Enter Order ID (e.g. 12345)"
                            value="{{ request('order_id') }}">
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
                            <div class="progress-step" id="step-pending">
                                <div class="step-icon"><i class="fas fa-receipt"></i></div>
                                <div class="step-label">Placed</div>
                            </div>
                            <div class="progress-line" id="line-1"></div>
                            <div class="progress-step" id="step-confirmed">
                                <div class="step-icon"><i class="fas fa-check"></i></div>
                                <div class="step-label">Confirmed</div>
                            </div>
                            <div class="progress-line" id="line-2"></div>
                            <div class="progress-step" id="step-preparing">
                                <div class="step-icon"><i class="fas fa-fire"></i></div>
                                <div class="step-label">Preparing</div>
                            </div>
                            <div class="progress-line" id="line-3"></div>
                            <div class="progress-step" id="step-ready">
                                <div class="step-icon"><i class="fas fa-bell"></i></div>
                                <div class="step-label">Ready</div>
                            </div>
                            <div class="progress-line" id="line-4"></div>
                            <div class="progress-step" id="step-completed">
                                <div class="step-icon"><i class="fas fa-check-double"></i></div>
                                <div class="step-label">Done</div>
                            </div>
                        </div>
                        <div class="status-footer">
                            <div class="status-info-row">
                                <span><i class="fas fa-user"></i> <span id="displayCustName"></span></span>
                                <span><i class="fas fa-concierge-bell"></i> <span id="displayOrderType"></span></span>
                                <span><i class="fas fa-wallet"></i> Total: <strong id="displayTotal"></strong></span>
                            </div>
                            <div id="displayItems" style="margin-top:14px; border-top:1px solid #f0ebe4; padding-top:12px;"></div>
                        </div>
                    </div>
                </div>

                <div class="status-not-found" id="statusNotFound" style="display:none;">
                    <i class="fas fa-search"></i>
                    <h3>Order Not Found</h3>
                    <p>We could not find an order with that ID. Please check and try again.</p>
                </div>
            @endif

        </div>
    </main>
@endsection

@section('scripts')
    <script>
        @if(request()->has('qr') && request()->has('table'))
        const TABLE_NUMBER = {{ (int) request('table') }};

        document.addEventListener('DOMContentLoaded', loadTableOrders);

        function loadTableOrders() {
            fetch(`{{ route('api.table-orders') }}?table=${TABLE_NUMBER}`)
                .then(r => r.json())
                .then(data => renderTableOrders(data))
                .catch(() => {
                    document.getElementById('tableOrdersContainer').innerHTML =
                        '<div class="no-active-orders"><i class="fas fa-exclamation-circle"></i><p>Could not load orders. Please refresh.</p></div>';
                });
        }

        function renderTableOrders(data) {
            const container = document.getElementById('tableOrdersContainer');
            if (!data.success || data.orders.length === 0) {
                container.innerHTML = `<div class="no-active-orders">
                    <i class="fas fa-check-circle" style="color:#27ae60;"></i>
                    <p>No active orders for this table.</p>
                    <p style="font-size:0.8rem;">Scan QR to start ordering.</p>
                </div>`;
                return;
            }

            const steps = ['pending','confirmed','preparing','ready','completed'];
            const statusLabel = { pending:'Pending', confirmed:'Confirmed', preparing:'Preparing', ready:'Ready!', completed:'Done' };

            const cards = data.orders.map(order => {
                const idx = steps.indexOf(order.status);
                const progressHtml = steps.map((s, i) => {
                    const icons = ['fa-receipt','fa-check','fa-fire','fa-bell','fa-check-double'];
                    const labels = ['Placed','Confirmed','Preparing','Ready','Done'];
                    const done = i <= idx ? 'step-done' : '';
                    const active = i === idx ? 'step-active' : '';
                    const line = i < steps.length - 1
                        ? `<div class="progress-line ${i < idx ? 'line-done' : ''}"></div>`
                        : '';
                    return `<div class="progress-step ${done} ${active}">
                        <div class="step-icon"><i class="fas ${icons[i]}"></i></div>
                        <div class="step-label">${labels[i]}</div>
                    </div>${line}`;
                }).join('');

                const itemsHtml = order.items.map(item =>
                    `<div class="order-item-row">
                        <span>${item.name} <span style="color:#aaa;">x${item.quantity}</span></span>
                        <span>RM ${parseFloat(item.price).toFixed(2)}</span>
                    </div>`
                ).join('');

                const badgeColor = order.status === 'ready' ? '#27ae60' : order.status === 'preparing' ? '#e67e22' : '#c0392b';

                return `<div class="order-card">
                    <div class="order-card-header">
                        <div>
                            <h3>Order #${order.id}</h3>
                            <small>${order.created_at} &bull; ${order.order_type}</small>
                        </div>
                        <span class="status-badge" style="background:${badgeColor}; color:#fff; padding:4px 12px; border-radius:20px; font-size:0.8rem;">
                            ${statusLabel[order.status] || order.status}
                        </span>
                    </div>
                    <div class="order-progress">${progressHtml}</div>
                    <div class="order-card-body">${itemsHtml}</div>
                    <div class="order-card-footer">
                        <span>Order Total</span>
                        <span>RM ${parseFloat(order.total).toFixed(2)}</span>
                    </div>
                </div>`;
            }).join('');

            const grandTotal = `<div class="grand-total-card">
                <span><i class="fas fa-receipt"></i> Table ${TABLE_NUMBER} Total</span>
                <span>RM ${parseFloat(data.grand_total).toFixed(2)}</span>
            </div>`;

            container.innerHTML = `<div class="order-cards-list">${cards}</div>${grandTotal}`;
        }

        @else
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
                if (order.items && order.items.length) {
                    document.getElementById('displayItems').innerHTML =
                        '<strong style="font-size:0.85rem; color:#2c3e50;">Items Ordered</strong>' +
                        order.items.map(i =>
                            `<div style="display:flex; justify-content:space-between; font-size:0.85rem; padding:5px 0; border-bottom:1px dashed #f0f0f0; color:#555;">
                                <span>${i.name} <span style="color:#aaa;">x${i.quantity}</span></span>
                                <span>RM ${parseFloat(i.price).toFixed(2)}</span>
                            </div>`
                        ).join('');
                }
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
                const steps = ['pending', 'confirmed', 'preparing', 'ready', 'completed'];
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
        @endif
    </script>
@endsection
