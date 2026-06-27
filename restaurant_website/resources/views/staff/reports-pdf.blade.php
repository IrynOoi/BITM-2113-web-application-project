<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        h1, h2, h3 {
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .summary-box {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 30px;
            background-color: #f9f9f9;
        }
        .chart-container {
            text-align: center;
            margin-bottom: 40px;
            page-break-inside: avoid;
        }
        .chart-container img {
            max-width: 100%;
            height: 300px; /* fixed height for PDF rendering */
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Restoran SUP TULANG ZZ</h1>
        <h2>Sales Report</h2>
        <p>Generated on: {{ now()->format('d M Y, h:i A') }}</p>
    </div>

    <div class="summary-box">
        <h3 style="margin-top: 0;">Summary Snapshot</h3>
        <p><strong>Daily Orders (Today):</strong> {{ $dailyOrders }}</p>
        <p><strong>Daily Revenue (Today):</strong> RM {{ number_format($dailyRevenue, 2) }}</p>
        <p><strong>Weekly Orders (This Week):</strong> {{ $weeklyOrders }}</p>
        <p><strong>Weekly Revenue (This Week):</strong> RM {{ number_format($weeklyRevenue, 2) }}</p>
    </div>

    <div class="chart-container">
        <h3>Daily Revenue (Last 7 Days)</h3>
        <img src="{{ $dailyChartUrl }}" alt="Daily Revenue Chart">
    </div>

    <div class="chart-container">
        <h3>Monthly Revenue ({{ date('Y') }})</h3>
        <img src="{{ $monthlyChartUrl }}" alt="Monthly Revenue Chart">
    </div>
</body>
</html>
