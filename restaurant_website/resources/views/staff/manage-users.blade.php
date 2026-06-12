@extends('layouts.staff')

@section('title', 'Manage Users - Restoran SUP TULANG ZZ')

@section('content')
<div class="staff-header">
    <h1>Manage Users</h1>
    <button class="btn-add"><i class="fas fa-plus"></i> Add User</button>
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
                    <td><span class="status-badge {{ $user->is_active ? 'available' : 'unavailable' }}">{{ $user->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td><button class="btn-edit"><i class="fas fa-edit"></i></button> <button class="btn-delete"><i class="fas fa-trash"></i></button></td>
                </tr>
            @empty
                <tr><td>Admin</td><td>admin@suptulang.com</td><td><span class="role-badge admin">Admin</span></td><td><span class="status-badge available">Active</span></td><td><button class="btn-edit"><i class="fas fa-edit"></i></button> <button class="btn-delete"><i class="fas fa-trash"></i></button></td></tr>
                <tr><td>Chef Zulkifli</td><td>chef@suptulang.com</td><td><span class="role-badge staff">Staff</span></td><td><span class="status-badge available">Active</span></td><td><button class="btn-edit"><i class="fas fa-edit"></i></button> <button class="btn-delete"><i class="fas fa-trash"></i></button></td></tr>
                <tr><td>Waiter Ali</td><td>ali@suptulang.com</td><td><span class="role-badge waiter">Waiter</span></td><td><span class="status-badge available">Active</span></td><td><button class="btn-edit"><i class="fas fa-edit"></i></button> <button class="btn-delete"><i class="fas fa-trash"></i></button></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
