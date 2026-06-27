<!-- manage-users.blade.php -->
<!-- manage-users.blade.php -->
@extends('layouts.staff')

@section('title', 'Manage Users - Restoran SUP TULANG ZZ')

@section('content')
    <div class="staff-header">
        <h1>Manage Users</h1>
        <button class="btn-add" onclick="document.getElementById('addUserModal').style.display='flex'"><i
                class="fas fa-plus"></i> Add User</button>
    </div>

    <div class="table-responsive">
        <table class="staff-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><span class="role-badge {{ $user->role }}">{{ ucfirst($user->role) }}</span></td>
                        <td>
                            <span class="status-badge {{ $user->is_active ? 'available' : 'unavailable' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div style="display:flex; gap:5px;">
                                @php
                                    $canManage = (Auth::user()->role === 'admin' ||
                                        (Auth::user()->role === 'staff' && $user->role === 'customer'));
                                @endphp

                                @if($canManage)
                                    <!-- Toggle Status -->
                                    <form method="POST" action="{{ route('staff.users.toggle', $user->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-toggle"
                                            style="border:none; cursor:pointer; background:none; font-size:1.5em; color: {{ $user->is_active ? '#28a745' : '#dc3545' }};"
                                            title="{{ $user->is_active ? 'Deactivate' : 'Reactivate' }}">
                                            <i class="fas {{ $user->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                        </button>
                                    </form>

                                    <!-- Edit -->
                                    <button class="btn-edit" onclick="openEditUserModal({{ $user }})"
                                        style="border:none; cursor:pointer; background:none; font-size:1.2em; color:#007bff;"
                                        title="Edit User"><i class="fas fa-edit"></i></button>

                                    <!-- Delete -->
                                    <form method="POST" action="{{ route('staff.users.destroy', $user->id) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete"
                                            style="border:none; cursor:pointer; background:none; font-size:1.2em; color: #dc3545;"
                                            title="Delete User">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @else
                                    <span style="color:#6c757d; font-size: 0.9em; font-style: italic;">No access</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add User Modal -->
    <div class="modal-overlay" id="addUserModal" style="display: none;">
        <div class="modal-card">
            <div class="modal-header">
                <h2>Add New User</h2>
                <button class="modal-close" onclick="document.getElementById('addUserModal').style.display='none'"><i
                        class="fas fa-times"></i></button>
            </div>
            <form method="POST" action="{{ route('staff.users.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Full Name</label>
                        <input type="text" name="full_name" class="filter-input" style="width: 100%; margin-top:5px;"
                            required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Email</label>
                        <input type="email" name="email" class="filter-input" style="width: 100%; margin-top:5px;" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="filter-input" style="width: 100%; margin-top:5px;">
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Role</label>
                        @if(Auth::user()->role === 'admin')
                            <select name="role" class="filter-input" style="width: 100%; margin-top:5px;" required>
                                <option value="customer">Customer</option>
                                <option value="staff">Staff</option>
                                <option value="admin">Admin</option>
                            </select>
                        @else
                            {{-- Staff: only customer allowed --}}
                            <input type="hidden" name="role" value="customer">
                            <p style="margin-top:5px; font-weight:500;">Customer (only)</p>
                        @endif
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Password</label>
                        <input type="password" name="password" class="filter-input" style="width: 100%; margin-top:5px;"
                            required minlength="8">
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="filter-input"
                            style="width: 100%; margin-top:5px;" required minlength="8">
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel"
                        onclick="document.getElementById('addUserModal').style.display='none'">Cancel</button>
                    <button type="submit" class="btn-add">Add User</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal-overlay" id="editUserModal" style="display: none;">
        <div class="modal-card">
            <div class="modal-header">
                <h2>Edit User</h2>
                <button class="modal-close" onclick="document.getElementById('editUserModal').style.display='none'"><i
                        class="fas fa-times"></i></button>
            </div>
            <form method="POST" id="editUserForm" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Full Name</label>
                        <input type="text" name="full_name" id="edit_full_name" class="filter-input"
                            style="width: 100%; margin-top:5px;" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Email</label>
                        <input type="email" name="email" id="edit_email" class="filter-input"
                            style="width: 100%; margin-top:5px;" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Phone Number</label>
                        <input type="text" name="phone" id="edit_phone" class="filter-input"
                            style="width: 100%; margin-top:5px;">
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Role</label>
                        @if(Auth::user()->role === 'admin')
                            <select name="role" id="edit_role" class="filter-input" style="width: 100%; margin-top:5px;"
                                required>
                                <option value="customer">Customer</option>
                                <option value="staff">Staff</option>
                                <option value="admin">Admin</option>
                            </select>
                        @else
                            {{-- Staff: role is hidden and forced to customer --}}
                            <input type="hidden" name="role" id="edit_role" value="customer">
                            <p style="margin-top:5px; font-weight:500;">Customer (cannot change)</p>
                        @endif
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Password (Leave blank to keep current)</label>
                        <input type="password" name="password" class="filter-input" style="width: 100%; margin-top:5px;"
                            minlength="8">
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="filter-input"
                            style="width: 100%; margin-top:5px;" minlength="8">
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel"
                        onclick="document.getElementById('editUserModal').style.display='none'">Cancel</button>
                    <button type="submit" class="btn-edit"
                        style="background-color:#007bff; color:white; border:none; padding:10px 15px; border-radius:5px; cursor:pointer;">Update
                        User</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditUserModal(user) {
            document.getElementById('editUserForm').action = `/staff/users/${user.id}`;
            document.getElementById('edit_full_name').value = user.full_name;
            document.getElementById('edit_email').value = user.email;
            document.getElementById('edit_phone').value = user.phone || '';

            @if(Auth::user()->role === 'admin')
                document.getElementById('edit_role').value = user.role;
            @else
                // For staff, the role input is hidden and always 'customer'
                // We can optionally display the current role for info, but it's not editable.
                // The hidden input is already set to 'customer', so we don't change it.
                // If you want to show the current role in the label, you can add a separate span.
            @endif

            document.getElementById('editUserModal').style.display = 'flex';
        }
    </script>
@endsection