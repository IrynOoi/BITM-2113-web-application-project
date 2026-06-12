@extends('layouts.staff')

@section('title', 'Manage Tables - Restoran SUP TULANG ZZ')

@section('content')
<div class="staff-header">
    <h1>Manage Tables</h1>
    <button class="btn-add" id="btnAddTable"><i class="fas fa-plus"></i> Add Table</button>
</div>

<div class="tables-grid">
    @for($i = 1; $i <= 30; $i++)
        <div class="table-card {{ $i <= 8 ? 'occupied' : 'available' }}">
            <div class="table-qr">
                <img src="{{ asset('assets/images/Table-QRs/qr'.$i.'.jpeg') }}" alt="QR Code" onerror="this.style.display='none'">
            </div>
            <span class="table-num">Table {{ $i }}</span>
            <span class="table-status">{{ $i <= 8 ? 'Occupied' : 'Available' }}</span>
            @if($i <= 8)
                <small>3 pax - RM 45.00</small>
            @endif
            <button class="btn-table-action" onclick="viewTable({{ $i }})">View</button>
        </div>
    @endfor
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
                <div class="detail-row"><span class="detail-label">Pax</span><span class="detail-value" id="modalPax">-</span></div>
                <div class="detail-row"><span class="detail-label">Total</span><span class="detail-value" id="modalTotal">-</span></div>
            </div>
        </div>
        <div class="modal-actions"><button class="btn-cancel" onclick="closeModal()">Close</button></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function viewTable(tableNum) {
        const modal = document.getElementById('tableModal');
        document.getElementById('modalTableTitle').textContent = 'Table ' + tableNum;
        const qrImg = document.getElementById('modalQrImage');
        qrImg.src = `${window.restaurantAssetBase}/images/Table-QRs/qr${tableNum}.jpeg`;
        qrImg.style.display = 'block';
        if (tableNum <= 8) {
            document.getElementById('modalStatus').innerHTML = '<span class="status-badge preparing">Occupied</span>';
            document.getElementById('modalOrder').textContent = '#102' + tableNum;
            document.getElementById('modalPax').textContent = '3 pax';
            document.getElementById('modalTotal').textContent = 'RM 45.00';
        } else {
            document.getElementById('modalStatus').innerHTML = '<span class="status-badge available">Available</span>';
            document.getElementById('modalOrder').textContent = '-';
            document.getElementById('modalPax').textContent = '-';
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
    document.getElementById('btnAddTable').addEventListener('click', function() {
        alert('Table adding UI is ready for backend expansion.');
    });
</script>
@endsection
