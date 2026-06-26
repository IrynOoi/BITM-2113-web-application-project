<!-- customer/profile.blade.php -->
@extends('layouts.frontend')

@section('title', 'Edit Profile - Restoran SUP TULANG ZZ')

@section('styles')
    @include('customer.partials.account-styles')
@endsection

@section('content')
    <main class="dashboard-page">
        <div class="container">
            <div class="dashboard-layout">
                @include('customer.partials.account-sidebar')
                <div class="dashboard-main">
                    <div class="dashboard-header">
                        <h1>Edit Profile</h1>
                        <p>Update your personal information</p>
                    </div>

                    @if(session('success'))
                        <div class="alert-success"><i class="fas fa-check-circle"></i> Profile updated successfully!</div>
                    @endif
                    @if(session('error') === 'wrong_pw')
                        <div class="alert-error"><i class="fas fa-exclamation-circle"></i> Current password is incorrect.</div>
                    @endif
                    @if($errors->any())
                        <div class="alert-error"><i class="fas fa-exclamation-circle"></i> Please check the highlighted fields
                            and try again.</div>
                    @endif

                    <div class="profile-card">
                        <form class="profile-form" method="POST" action="{{ route('customer.profile.update') }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="fullName">Full Name <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="fullName" name="fullName"
                                            value="{{ old('fullName', Auth::user()->full_name) }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-phone"></i>
                                        <input type="tel" id="phone" name="phone"
                                            value="{{ old('phone', Auth::user()->phone) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" value="{{ Auth::user()->email }}" readonly class="readonly-input">
                                </div>
                                <small class="field-note">Email cannot be changed</small>
                            </div>

                            <div class="form-group">
                                <label for="address">Default Address</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <textarea id="address" name="address" rows="3"
                                        placeholder="Your default delivery address">{{ old('address', Auth::user()->address) }}</textarea>
                                </div>
                            </div>

                            <div class="profile-section-divider"><span>Change Password (optional)</span></div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="currentPassword">Current Password</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="currentPassword" name="currentPassword"
                                            placeholder="Enter current password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="newPassword" name="newPassword"
                                            placeholder="Min 8 characters">
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-save-profile"><i class="fas fa-save"></i> Save
                                    Changes</button>
                                <a href="{{ route('customer.dashboard') }}" class="btn-cancel-profile"><i
                                        class="fas fa-times"></i> Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection