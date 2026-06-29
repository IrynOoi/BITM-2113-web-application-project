@extends('layouts.staff')

@section('title', 'Sales Reports - Restoran SUP TULANG ZZ')

@section('content')
<div class="staff-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">
    <h1>Sales Reports</h1>
    <a href="{{ route('staff.reports.export') }}" class="btn-primary" style="text-decoration:none; padding:10px 20px; border-radius:8px; background:#e67e22; color:white; font-weight:600;">
        <i class="fas fa-file-pdf"></i> Export PDF
    </a>
</div>



{{-- Stats Grid --}}
<div class="stats-grid" style="margin-bottom:24px;">
    <div class="stat-card">
        <div class="stat-icon pending"><i class="fas fa-calendar-day"></i></div>
        <div class="stat-info">
            <span class="stat-value">{{ $dailyOrders }}</span>
            <span class="stat-label">Today's Orders</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orders"><i class="fas fa-money-bill-wave"></i></div>
        <div class="stat-info">
            <span class="stat-value">RM {{ number_format($dailyRevenue, 2) }}</span>
            <span class="stat-label">Today's Revenue</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon completed"><i class="fas fa-calendar-alt"></i></div>
        <div class="stat-info">
            <span class="stat-value">{{ $monthlyOrders }}</span>
            <span class="stat-label">Monthly Orders</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon tables"><i class="fas fa-chart-line"></i></div>
        <div class="stat-info">
            <span class="stat-value">RM {{ number_format($monthlyRevenue, 2) }}</span>
            <span class="stat-label">Monthly Revenue</span>
        </div>
    </div>
</div>

{{-- Period Summary + Type Breakdown --}}
<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px;">

    <div style="background:#fff; border-radius:14px; border:1px solid #f0ebe4; padding:20px;">
        <h3 style="font-size:0.95rem; font-weight:700; color:#2c3e50; margin-bottom:16px;">
            <i class="fas fa-filter" style="color:#c0392b;"></i> All Time Summary
        </h3>
        <div style="display:flex; flex-direction:column; gap:12px;">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <span style="color:#666; font-size:0.875rem;">Total Orders</span>
                <span style="font-weight:700; font-size:1.1rem; color:#2c3e50;">{{ $periodOrders }}</span>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <span style="color:#666; font-size:0.875rem;">Total Revenue</span>
                <span style="font-weight:700; font-size:1.1rem; color:#27ae60;">RM {{ number_format($periodRevenue, 2) }}</span>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <span style="color:#666; font-size:0.875rem;">Avg per Order</span>
                <span style="font-weight:700; font-size:1.1rem; color:#2c3e50;">
                    RM {{ $periodOrders > 0 ? number_format($periodRevenue / $periodOrders, 2) : '0.00' }}
                </span>
            </div>
        </div>
    </div>

    <div style="background:#fff; border-radius:14px; border:1px solid #f0ebe4; padding:20px;">
        <h3 style="font-size:0.95rem; font-weight:700; color:#2c3e50; margin-bottom:16px;">
            <i class="fas fa-concierge-bell" style="color:#c0392b;"></i> Order Type Breakdown
        </h3>
        @foreach(['dine-in' => ['fa-utensils','#3498db'], 'pickup' => ['fa-shopping-bag','#e67e22'], 'delivery' => ['fa-motorcycle','#27ae60']] as $type => [$icon, $color])
            @php $t = $typeBreakdown->get($type) @endphp
            <div style="display:flex; justify-content:space-between; align-items:center; padding:8px 0; border-bottom:1px dashed #f0ebe4;">
                <span style="display:flex; align-items:center; gap:8px; font-size:0.875rem; color:#444;">
                    <i class="fas {{ $icon }}" style="color:{{ $color }}; width:16px;"></i>
                    {{ ucfirst($type) }}
                </span>
                <span style="font-size:0.875rem;">
                    <strong>{{ $t ? $t->count : 0 }}</strong>
                    <span style="color:#aaa; font-size:0.78rem;"> orders</span>
                    &nbsp;Â·&nbsp;
                    <strong style="color:#27ae60;">RM {{ $t ? number_format($t->revenue, 2) : '0.00' }}</strong>
                </span>
            </div>
        @endforeach
    </div>
</div>

{{-- Charts --}}
<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px;">
    <div style="background:#fff; border-radius:14px; border:1px solid #f0ebe4; padding:20px;">
        <h3 style="font-size:0.95rem; font-weight:700; color:#2c3e50; margin-bottom:16px;">
            <i class="fas fa-chart-bar" style="color:#c0392b;"></i> Last 7 Days Revenue
        </h3>
        <canvas id="dailyChart" height="200"></canvas>
    </div>
    <div style="background:#fff; border-radius:14px; border:1px solid #f0ebe4; padding:20px;">
        <h3 style="font-size:0.95rem; font-weight:700; color:#2c3e50; margin-bottom:16px;">
            <i class="fas fa-chart-line" style="color:#c0392b;"></i> Monthly Revenue ({{ date('Y') }})
        </h3>
        <canvas id="monthlyChart" height="200"></canvas>
    </div>
</div>

{{-- Top Items --}}
<div style="background:#fff; border-radius:14px; border:1px solid #f0ebe4; padding:20px;">
    <h3 style="font-size:0.95rem; font-weight:700; color:#2c3e50; margin-bottom:16px;">
        <i class="fas fa-trophy" style="color:#e67e22;"></i> Top 5 Bestselling Items
        <small style="font-weight:400; color:#aaa; font-size:0.78rem;">(All Time)</small>
    </h3>
    <div class="table-responsive">
        <table class="staff-table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Item</th>
                    <th>Qty Sold</th>
                    <th>Revenue</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topItems as $i => $item)
                    <tr>
                        <td>
                            @if($i === 0) ðŸ¥‡
                            @elseif($i === 1) ðŸ¥ˆ
                            @elseif($i === 2) ðŸ¥‰
                            @else #{{ $i + 1 }}
                            @endif
                        </td>
                        <td><strong>{{ $item->item_name }}</strong></td>
                        <td>{{ $item->total_quantity }}</td>
                        <td style="color:#27ae60; font-weight:700;">RM {{ number_format($item->total_revenue, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-4">No sales data for this period.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const dailyLabels   = @json($dailyLabels);
    const dailyData     = @json($dailyData);
    const monthlyLabels = @json($monthlyLabels);
    const monthlyData   = @json($monthlyData);

    new Chart(document.getElementById('dailyChart'), {
        type: 'bar',
        data: {
            labels: dailyLabels,
            datasets: [{
                label: 'Revenue (RM)',
                data: dailyData,
                backgroundColor: 'rgba(192, 57, 43, 0.75)',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { callback: v => 'RM ' + v } } }
        }
    });

    new Chart(document.getElementById('monthlyChart'), {
        type: 'bar',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Revenue (RM)',
                data: monthlyData,
                backgroundColor: 'rgba(39, 174, 96, 0.75)',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { callback: v => 'RM ' + v } } }
        }
    });
</script>
@endsection

