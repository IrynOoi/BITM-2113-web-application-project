@extends('layouts.staff')

@section('title', 'Manage Users - Restoran SUP TULANG ZZ')

@section('content')
<div class="staff-header">
    <h1>Manage Users</h1>
    <button class="btn-add" onclick="document.getElementById('addUserModal').style.display='flex'"><i class="fas fa-plus"></i> Add User</button>
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
                            <form method="POST" action="{{ route('staff.users.toggle', $user->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-toggle" style="border:none; cursor:pointer; background:none; font-size:1.5em; color: {{ $user->is_active ? '#28a745' : '#dc3545' }};" title="{{ $user->is_active ? 'Deactivate' : 'Reactivate' }}">
                                    <i class="fas {{ $user->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                </button>
                            </form>
                            <button class="btn-edit" onclick="alert('Edit UI ready for expansion')"><i class="fas fa-edit"></i></button> 
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-4">No users found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="modal-overlay" id="addUserModal" style="display: none;">
    <div class="modal-card">
        <div class="modal-header">
            <h2>Add New User</h2>
            <button class="modal-close" onclick="document.getElementById('addUserModal').style.display='none'"><i class="fas fa-times"></i></button>
        </div>
        <form method="POST" action="{{ route('staff.users.store') }}">
            @csrf
            <div class="modal-body">
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Full Name</label>
                    <input type="text" name="full_name" class="filter-input" style="width: 100%; margin-top:5px;" required>
                </div>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Email</label>
                    <input type="email" name="email" class="filter-input" style="width: 100%; margin-top:5px;" required>
                </div>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Role</label>
                    <select name="role" class="filter-input" style="width: 100%; margin-top:5px;" required>
                        <option value="customer">Customer</option>
                        <option value="staff">Staff</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Password</label>
                    <input type="password" name="password" class="filter-input" style="width: 100%; margin-top:5px;" required minlength="8">
                </div>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="filter-input" style="width: 100%; margin-top:5px;" required minlength="8">
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="document.getElementById('addUserModal').style.display='none'">Cancel</button>
                <button type="submit" class="btn-add">Add User</button>
            </div>
        </form>
    </div>
</div>
@endsection
