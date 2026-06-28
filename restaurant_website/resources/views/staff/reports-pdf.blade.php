<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales Report</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; padding: 30px; }

        .header { text-align: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 3px solid #c0392b; }
        .header h1 { font-size: 20px; color: #c0392b; margin-bottom: 4px; }
        .header h2 { font-size: 14px; color: #2c3e50; font-weight: normal; margin-bottom: 4px; }
        .header p { font-size: 11px; color: #888; }

        .section { margin-bottom: 22px; }
        .section-title { font-size: 13px; font-weight: bold; color: #2c3e50; margin-bottom: 10px; padding-bottom: 4px; border-bottom: 1px solid #e0e0e0; }

        /* Stats grid */
        .stats-grid { display: table; width: 100%; margin-bottom: 18px; }
        .stat-box { display: table-cell; width: 25%; padding: 10px 8px; border: 1px solid #e0e0e0; background: #f9f9f9; text-align: center; }
        .stat-box .val { font-size: 16px; font-weight: bold; color: #c0392b; display: block; }
        .stat-box .lbl { font-size: 10px; color: #888; display: block; margin-top: 2px; }

        /* Period box */
        .period-box { background: #fdf8f6; border: 1px solid #f0ebe4; padding: 12px 16px; border-radius: 4px; margin-bottom: 18px; }
        .period-box .row { display: flex; justify-content: space-between; padding: 4px 0; border-bottom: 1px dashed #e0e0e0; }
        .period-box .row:last-child { border-bottom: none; }

        /* Table */
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th { background: #2c3e50; color: #fff; padding: 8px 10px; text-align: left; font-size: 11px; }
        td { padding: 7px 10px; border-bottom: 1px solid #f0f0f0; font-size: 11px; }
        tr:nth-child(even) td { background: #f9f9f9; }

        .green { color: #27ae60; font-weight: bold; }
        .red { color: #c0392b; }

        .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #aaa; border-top: 1px solid #e0e0e0; padding-top: 10px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Restoran SUP TULANG ZZ</h1>
        <h2>Sales Report</h2>
        <p>
            Period: <strong>{{ \Carbon\Carbon::parse($from)->format('d M Y') }}</strong>
            @if($from !== $to) â€“ <strong>{{ \Carbon\Carbon::parse($to)->format('d M Y') }}</strong> @endif
            &nbsp;|&nbsp; Generated: {{ now()->format('d M Y, h:i A') }}
        </p>
    </div>

    {{-- Summary Stats --}}
    <div class="section">
        <div class="section-title">Summary Snapshot</div>
        <div class="stats-grid">
            <div class="stat-box">
                <span class="val">{{ $dailyOrders }}</span>
                <span class="lbl">Today's Orders</span>
            </div>
            <div class="stat-box">
                <span class="val">RM {{ number_format($dailyRevenue, 2) }}</span>
                <span class="lbl">Today's Revenue</span>
            </div>
            <div class="stat-box">
                <span class="val">{{ $monthlyOrders }}</span>
                <span class="lbl">Monthly Orders</span>
            </div>
            <div class="stat-box">
                <span class="val">RM {{ number_format($monthlyRevenue, 2) }}</span>
                <span class="lbl">Monthly Revenue</span>
            </div>
        </div>
    </div>

    {{-- Period Summary --}}
    <div class="section">
        <div class="section-title">Period Summary ({{ \Carbon\Carbon::parse($from)->format('d M Y') }}@if($from !== $to) â€“ {{ \Carbon\Carbon::parse($to)->format('d M Y') }}@endif)</div>
        <div class="period-box">
            <div class="row">
                <span>Total Orders</span>
                <strong>{{ $periodOrders }}</strong>
            </div>
            <div class="row">
                <span>Total Revenue</span>
                <strong class="green">RM {{ number_format($periodRevenue, 2) }}</strong>
            </div>
            <div class="row">
                <span>Average per Order</span>
                <strong>RM {{ $periodOrders > 0 ? number_format($periodRevenue / $periodOrders, 2) : '0.00' }}</strong>
            </div>
        </div>
    </div>

    {{-- Order Type Breakdown --}}
    <div class="section">
        <div class="section-title">Order Type Breakdown</div>
        <table>
            <thead>
                <tr>
                    <th>Order Type</th>
                    <th>Orders</th>
                    <th>Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach(['dine-in', 'pickup', 'delivery'] as $type)
                    @php $t = $typeBreakdown->get($type) @endphp
                    <tr>
                        <td>{{ ucfirst($type) }}</td>
                        <td>{{ $t ? $t->count : 0 }}</td>
                        <td class="green">RM {{ $t ? number_format($t->revenue, 2) : '0.00' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Top Items --}}
    <div class="section">
        <div class="section-title">Top 5 Bestselling Items (Selected Period)</div>
        <table>
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
                        <td>#{{ $i + 1 }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->total_quantity }}</td>
                        <td class="green">RM {{ number_format($item->total_revenue, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" style="text-align:center; color:#aaa;">No sales data for this period.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Daily Revenue Chart --}}
    <div class="section" style="page-break-inside:avoid;">
        <div class="section-title">Daily Revenue (Last 7 Days)</div>
        <div style="text-align:center; margin:10px 0;">
            <img src="{{ $dailyChartUrl }}" alt="Daily Revenue Chart" style="max-width:100%; height:220px;">
        </div>
        <table>
            <thead><tr><th>Date</th><th>Revenue (RM)</th></tr></thead>
            <tbody>
                @foreach($dailyLabels as $i => $label)
                    <tr>
                        <td>{{ $label }}</td>
                        <td class="{{ $dailyData[$i] > 0 ? 'green' : '' }}">RM {{ number_format($dailyData[$i], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Monthly Revenue Chart --}}
    <div class="section" style="page-break-inside:avoid;">
        <div class="section-title">Monthly Revenue ({{ date('Y') }})</div>
        <div style="text-align:center; margin:10px 0;">
            <img src="{{ $monthlyChartUrl }}" alt="Monthly Revenue Chart" style="max-width:100%; height:220px;">
        </div>
        <table>
            <thead><tr><th>Month</th><th>Revenue (RM)</th></tr></thead>
            <tbody>
                @foreach($monthlyLabels as $i => $label)
                    <tr>
                        <td>{{ $label }} {{ date('Y') }}</td>
                        <td class="{{ $monthlyData[$i] > 0 ? 'green' : '' }}">RM {{ number_format($monthlyData[$i], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        Restoran SUP TULANG ZZ &nbsp;Â·&nbsp; Sales Report &nbsp;Â·&nbsp; {{ now()->format('d M Y') }}
    </div>

</body>
</html>

