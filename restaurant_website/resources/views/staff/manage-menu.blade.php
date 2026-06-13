@extends('layouts.staff')

@section('title', 'Manage Menu - Restoran SUP TULANG ZZ')

@section('content')
<div class="staff-header">
    <h1>Manage Menu</h1>
</div>

<div class="filter-bar">
    <form method="GET" action="{{ route('staff.menu') }}" style="display:flex; gap:10px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search menu..." class="filter-input" style="width: 300px;">
        <button type="submit" class="btn-view">Search</button>
        @if(request('search'))
            <a href="{{ route('staff.menu') }}" class="btn-cancel" style="padding:8px 12px; text-decoration:none;">Clear</a>
        @endif
    </form>
</div>

<div class="table-responsive">
    <table class="staff-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="menuTableBody">
            @forelse($menuItems as $item)
                <tr>
                    <td>
                        @if($item->image_path)
                            <img src="{{ Storage::url($item->image_path) }}" class="menu-thumb" alt="{{ $item->name }}" style="width:50px; height:50px; object-fit:cover; border-radius:4px;">
                        @else
                            <img src="{{ asset('assets/images/menu-image/item'.$item->id.'.png') }}" class="menu-thumb" alt="{{ $item->name }}" style="width:50px; height:50px; object-fit:cover; border-radius:4px;" onerror="this.style.display='none'">
                        @endif
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ ucfirst($item->category) }}</td>
                    <td>RM {{ number_format($item->price, 2) }}</td>
                    <td>
                        <span class="status-badge {{ $item->is_available ? 'available' : 'unavailable' }}">
                            {{ $item->is_available ? 'Available' : 'Out of Stock' }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex; gap:5px;">
                            <form method="POST" action="{{ route('staff.menu.toggle', $item->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-toggle {{ $item->is_available ? 'available' : 'unavailable' }}" title="Toggle Availability" style="border:none; cursor:pointer; background:none; font-size:1.5em; color: {{ $item->is_available ? '#28a745' : '#dc3545' }};">
                                    <i class="fas {{ $item->is_available ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                </button>
                            </form>
                            <form method="POST" action="{{ route('staff.menu.destroy', $item->id) }}" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" style="background:#ff4d4f; color:white; border:none; padding:5px 10px; border-radius:4px; cursor:pointer;" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-4">No menu items found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection


