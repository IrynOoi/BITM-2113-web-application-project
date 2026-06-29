@extends('layouts.staff')

@section('title', 'Manage Menu - Restoran SUP TULANG ZZ')

@section('content')
    <div class="staff-header">
        <h1>Manage Menu</h1>
        <button class="btn-add" onclick="document.getElementById('addMenuModal').style.display='flex'"><i
                class="fas fa-plus"></i> Add Item</button>
    </div>

    <div class="filter-bar">
        <form method="GET" action="{{ route('staff.menu') }}" style="display:flex; gap:10px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search menu..."
                class="filter-input" style="width: 300px;">
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
                                <img src="{{ asset('assets/images/menu-image/' . basename($item->image_path)) }}" class="menu-thumb" alt="{{ $item->name }}"
                                    style="width:50px; height:50px; object-fit:cover; border-radius:4px;" onerror="this.src='{{ asset('assets/images/menu-image/item' . $item->id . '.png') }}'">
                            @else
                                <img src="{{ asset('assets/images/menu-image/item' . $item->id . '.png') }}" class="menu-thumb"
                                    alt="{{ $item->name }}" style="width:50px; height:50px; object-fit:cover; border-radius:4px;"
                                    onerror="this.style.display='none'">
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
                            <div style="display:flex; gap:5px; align-items:center;">
                                <form method="POST" action="{{ route('staff.menu.toggle', $item->id) }}" style="margin:0;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="btn-toggle {{ $item->is_available ? 'available' : 'unavailable' }}"
                                        title="Toggle Availability"
                                        style="border:none; cursor:pointer; background:none; font-size:1.5em; color: {{ $item->is_available ? '#28a745' : '#dc3545' }};">
                                        <i class="fas {{ $item->is_available ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                    </button>
                                </form>
                                <button type="button" class="btn-edit" onclick="openEditMenuModal({{ $item }})"
                                    style="border:none; cursor:pointer; background:none; font-size:1.2em; color:#007bff;"
                                    title="Edit Item">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form method="POST" action="{{ route('staff.menu.destroy', $item->id) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this item?');" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete"
                                        style="background:none; color:#dc3545; border:none; cursor:pointer; font-size:1.2em;"
                                        title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No menu items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </div>

    <!-- Add Menu Modal -->
    <div class="modal-overlay" id="addMenuModal" style="display: none;">
        <div class="modal-card">
            <div class="modal-header">
                <h2>Add New Menu Item</h2>
                <button class="modal-close" onclick="document.getElementById('addMenuModal').style.display='none'"><i
                        class="fas fa-times"></i></button>
            </div>
            <form method="POST" action="{{ route('staff.menu.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Name</label>
                        <input type="text" name="name" class="filter-input" style="width: 100%; margin-top:5px;" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Description</label>
                        <textarea name="description" class="filter-input"
                            style="width: 100%; margin-top:5px; height: 60px;"></textarea>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Price (RM)</label>
                        <input type="number" step="0.01" name="price" class="filter-input"
                            style="width: 100%; margin-top:5px;" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Category</label>
                        <select name="category" class="filter-input" style="width: 100%; margin-top:5px;" required>
                            <option value="signature-sup">Sup ZZ</option>
                            <option value="signature-mee">Mee Rebus ZZ</option>
                            <option value="sarapan-panas">Sarapan Panas</option>
                            <option value="sarapan-roti">Roti Bakar</option>
                            <option value="roti-canai">Roti Canai</option>
                            <option value="set-nasi">Set Nasi</option>
                            <option value="set-panas">Set Masakan</option>
                            <option value="ikan-siakap">Ikan Siakap</option>
                            <option value="ikan-bakar">Bakar-Bakar</option>
                            <option value="alacarte-sayur">Sayur</option>
                            <option value="alacarte-lauk">Lauk Thai</option>
                            <option value="alacarte-tepung">Goreng Tepung</option>
                            <option value="alacarte-sup">Sup Ala Thai</option>
                            <option value="alacarte-tomyam">Tomyam</option>
                            <option value="alacarte-meekuah">Mee Kuah</option>
                            <option value="western">Western</option>
                            <option value="goreng-nasi">Nasi Goreng</option>
                            <option value="goreng-mee">Mee Goreng</option>
                            <option value="drinks-noncoffee">Drinks</option>
                            <option value="drinks-jus">Jus</option>
                            <option value="drinks-dessert">Dessert</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Image</label>
                        <input type="file" name="image" class="filter-input" accept="image/*"
                            style="width: 100%; margin-top:5px;">
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel"
                        onclick="document.getElementById('addMenuModal').style.display='none'">Cancel</button>
                    <button type="submit" class="btn-add">Add Item</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Menu Modal -->
    <div class="modal-overlay" id="editMenuModal" style="display: none;">
        <div class="modal-card">
            <div class="modal-header">
                <h2>Edit Menu Item</h2>
                <button class="modal-close" onclick="document.getElementById('editMenuModal').style.display='none'"><i
                        class="fas fa-times"></i></button>
            </div>
            <form method="POST" id="editMenuForm" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Name</label>
                        <input type="text" name="name" id="edit_name" class="filter-input"
                            style="width: 100%; margin-top:5px;" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Description</label>
                        <textarea name="description" id="edit_description" class="filter-input"
                            style="width: 100%; margin-top:5px; height: 60px;"></textarea>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Price (RM)</label>
                        <input type="number" step="0.01" name="price" id="edit_price" class="filter-input"
                            style="width: 100%; margin-top:5px;" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Category</label>
                        <select name="category" id="edit_category" class="filter-input" style="width: 100%; margin-top:5px;" required>
                            <option value="signature-sup">Sup ZZ</option>
                            <option value="signature-mee">Mee Rebus ZZ</option>
                            <option value="sarapan-panas">Sarapan Panas</option>
                            <option value="sarapan-roti">Roti Bakar</option>
                            <option value="roti-canai">Roti Canai</option>
                            <option value="set-nasi">Set Nasi</option>
                            <option value="set-panas">Set Masakan</option>
                            <option value="ikan-siakap">Ikan Siakap</option>
                            <option value="ikan-bakar">Bakar-Bakar</option>
                            <option value="alacarte-sayur">Sayur</option>
                            <option value="alacarte-lauk">Lauk Thai</option>
                            <option value="alacarte-tepung">Goreng Tepung</option>
                            <option value="alacarte-sup">Sup Ala Thai</option>
                            <option value="alacarte-tomyam">Tomyam</option>
                            <option value="alacarte-meekuah">Mee Kuah</option>
                            <option value="western">Western</option>
                            <option value="goreng-nasi">Nasi Goreng</option>
                            <option value="goreng-mee">Mee Goreng</option>
                            <option value="drinks-noncoffee">Drinks</option>
                            <option value="drinks-jus">Jus</option>
                            <option value="drinks-dessert">Dessert</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Image (Leave blank to keep current)</label>
                        <input type="file" name="image" class="filter-input" accept="image/*"
                            style="width: 100%; margin-top:5px;">
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel"
                        onclick="document.getElementById('editMenuModal').style.display='none'">Cancel</button>
                    <button type="submit" class="btn-edit"
                        style="background-color:#007bff; color:white; border:none; padding:10px 15px; border-radius:5px; cursor:pointer;">Update
                        Item</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditMenuModal(item) {
            document.getElementById('editMenuForm').action = `/staff/menu/${item.id}`;
            document.getElementById('edit_name').value = item.name;
            document.getElementById('edit_description').value = item.description || '';
            document.getElementById('edit_price').value = item.price;
            document.getElementById('edit_category').value = item.category;
            document.getElementById('editMenuModal').style.display = 'flex';
        }
    </script>
@endsection