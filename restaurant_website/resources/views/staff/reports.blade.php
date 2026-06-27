@extends('layouts.staff')

@section('title', 'Sales Reports - Restoran SUP TULANG ZZ')

@section('content')
<div class="staff-header" style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Sales Reports</h1>
    <a href="{{ route('staff.reports.export') }}" class="btn-primary" style="text-decoration: none; padding: 10px 20px; border-radius: 5px; background-color: #f59e0b; color: white;">
        <i class="fas fa-file-pdf"></i> Export to PDF
    </a>
</div>

<div class="stats-grid">
    <div class="stat-card" style="cursor: pointer;" onclick="showChart('daily')">
        <div class="stat-icon pending"><i class="fas fa-shopping-cart"></i></div>
        <div class="stat-info">
            <span class="stat-value">{{ $dailyOrders }}</span>
            <span class="stat-label">Daily Orders</span>
        </div>
    </div>
    <div class="stat-card" style="cursor: pointer;" onclick="showChart('daily')">
        <div class="stat-icon orders"><i class="fas fa-money-bill-wave"></i></div>
        <div class="stat-info">
            <span class="stat-value">RM {{ number_format($dailyRevenue, 2) }}</span>
            <span class="stat-label">Daily Revenue</span>
        </div>
    </div>
    <div class="stat-card" style="cursor: pointer;" onclick="showChart('monthly')">
        <div class="stat-icon completed"><i class="fas fa-shopping-bag"></i></div>
        <div class="stat-info">
            <span class="stat-value">{{ $monthlyOrders }}</span>
            <span class="stat-label">Monthly Orders</span>
        </div>
    </div>
    <div class="stat-card" style="cursor: pointer;" onclick="showChart('monthly')">
        <div class="stat-icon tables"><i class="fas fa-chart-line"></i></div>
        <div class="stat-info">
            <span class="stat-value">RM {{ number_format($monthlyRevenue, 2) }}</span>
            <span class="stat-label">Monthly Revenue</span>
        </div>
    </div>
</div>

<div id="chartModal" class="modal-overlay" style="display: none;">
    <div class="modal-card" style="max-width: 850px; width: 90%;">
        <div class="modal-header">
            <h2 id="chartModalTitle">Revenue Chart</h2>
            <button class="modal-close" onclick="closeChartModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body" style="text-align: center;">
            <img id="chartImage" src="" alt="Chart" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        </div>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeChartModal()">Close</button>
        </div>
    </div>
</div>

<script>
    const dailyChartUrl = @json($dailyChartUrl);
    const monthlyChartUrl = @json($monthlyChartUrl);

    function showChart(type) {
        const modal = document.getElementById('chartModal');
        const img = document.getElementById('chartImage');
        const title = document.getElementById('chartModalTitle');
        
        if (type === 'daily') {
            title.textContent = 'Daily Revenue (Last 7 Days)';
            img.src = dailyChartUrl;
        } else if (type === 'monthly') {
            title.textContent = 'Monthly Revenue (' + new Date().getFullYear() + ')';
            img.src = monthlyChartUrl;
        }
        
        modal.style.display = 'flex';
    }

    function closeChartModal() {
        document.getElementById('chartModal').style.display = 'none';
    }
    
    document.getElementById('chartModal').addEventListener('click', function(e) {
        if (e.target === this) closeChartModal();
    });
</script>

<div class="staff-section" style="margin-top: 30px;">
    <div class="section-top">
        <h2>Top 5 Bestselling Menu Items</h2>
    </div>
    <div class="table-responsive">
        <table class="staff-table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Menu Item</th>
                    <th>Total Quantity Sold</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topItems as $index => $item)
                    <tr>
                        <td>#{{ $index + 1 }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->total_quantity }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4">No sales data available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
