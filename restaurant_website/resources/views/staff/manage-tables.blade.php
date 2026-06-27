@extends('layouts.staff')

@section('title', 'Manage Tables - Restoran SUP TULANG ZZ')

@section('content')
<div class="staff-header">
    <h1>Manage Tables</h1>
    <form method="POST" action="{{ route('staff.tables.store') }}" style="display:flex; gap:10px; align-items:center;">
        @csrf
        <input type="number" name="table_number" placeholder="Table Number" required min="1" max="30" class="filter-input" style="width: 150px;">
        <button type="submit" class="btn-add"><i class="fas fa-plus"></i> Add Table</button>
    </form>
</div>

@if ($errors->any())
    <div class="alert alert-danger" style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 8px; margin-bottom: 15px; border: 1px solid #f87171;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success" style="background-color: #dcfce7; color: #15803d; padding: 1rem; border-radius: 8px; margin-bottom: 15px; border: 1px solid #86efac;">
        {{ session('success') }}
    </div>
@endif

<div class="tables-grid">
    @php
        $localIp = request()->getHost();
        if ($localIp === '127.0.0.1' || $localIp === 'localhost') {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                exec('ipconfig', $output);
                foreach ($output as $line) {
                    if (preg_match('/IPv4 Address.*: (192\.168\.\d+\.\d+)/', $line, $matches)) {
                        $localIp = $matches[1];
                        if (substr($localIp, -2) !== '.1') break;
                    }
                }
            } else {
                $localIp = trim(exec("hostname -I | awk '{print $1}'")) ?: $localIp;
            }
        }
        $port = request()->getPort();
    @endphp

    @forelse($tables as $table)
        @php
            $qrOrderUrl = "http://{$localIp}:{$port}/customer/qr-order?table=" . $table->table_number;
            $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($qrOrderUrl);
            $activeOrder = \App\Models\Order::where('table_number', $table->table_number)
                                            ->whereIn('status', ['pending', 'confirmed', 'preparing', 'ready'])
                                            ->first();
            $isOccupied = $activeOrder ? true : false;
        @endphp
        <div class="table-card {{ $isOccupied ? 'occupied' : 'available' }}">
            <div class="table-qr">
                <img src="{{ $qrUrl }}" alt="QR Code">
            </div>
            <span class="table-num">Table {{ $table->table_number }}</span>
            <span class="table-status">{{ $isOccupied ? 'Occupied' : 'Available' }}</span>
            @if($isOccupied)
                <small>RM {{ number_format($activeOrder->total, 2) }}</small>
            @endif
            <div style="display:flex; gap:5px; margin-top:10px;">
                <button class="btn-table-action" onclick="viewTable({{ $table->table_number }}, '{{ $qrUrl }}', {{ $isOccupied ? 'true' : 'false' }}, '{{ $activeOrder ? '#'.$activeOrder->id : '-' }}', '{{ $activeOrder ? 'RM '.number_format($activeOrder->total, 2) : '-' }}')" style="flex:1;">View</button>
                <form method="POST" action="{{ route('staff.tables.destroy', $table->id) }}" onsubmit="return confirm('Are you sure you want to delete Table {{ $table->table_number }}?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete" style="background:#ff4d4f; color:white; border:none; padding:8px 12px; border-radius:4px; cursor:pointer;" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p>No tables configured.</p>
    @endforelse
</div>

<div class="modal-overlay" id="tableModal" style="display: none;">
    <div class="modal-card table-detail-modal">
        <div class="modal-header">
            <h2 id="modalTableTitle">Table 1</h2>
            <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="table-detail-qr">
                <img id="modalQrImage" src="" alt="QR Code" style="display:none;">
                <p class="qr-label">Table QR Code</p>
            </div>
            <div class="table-detail-info">
                <div class="detail-row"><span class="detail-label">Status</span><span class="detail-value" id="modalStatus">Available</span></div>
                <div class="detail-row"><span class="detail-label">Current Order</span><span class="detail-value" id="modalOrder">-</span></div>
                <div class="detail-row"><span class="detail-label">Total</span><span class="detail-value" id="modalTotal">-</span></div>
            </div>
        </div>
        <div class="modal-actions"><button class="btn-cancel" onclick="closeModal()">Close</button></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function viewTable(tableNum, qrUrl, isOccupied, orderId, total) {
        const modal = document.getElementById('tableModal');
        document.getElementById('modalTableTitle').textContent = 'Table ' + tableNum;
        const qrImg = document.getElementById('modalQrImage');
        qrImg.src = qrUrl;
        qrImg.style.display = 'block';
        if (isOccupied) {
            document.getElementById('modalStatus').innerHTML = '<span class="status-badge preparing">Occupied</span>';
            document.getElementById('modalOrder').textContent = orderId;
            document.getElementById('modalTotal').textContent = total;
        } else {
            document.getElementById('modalStatus').innerHTML = '<span class="status-badge available">Available</span>';
            document.getElementById('modalOrder').textContent = '-';
            document.getElementById('modalTotal').textContent = '-';
        }
        modal.style.display = 'flex';
    }
    function closeModal() {
        document.getElementById('tableModal').style.display = 'none';
    }
    document.getElementById('tableModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
</script>
@endsection
