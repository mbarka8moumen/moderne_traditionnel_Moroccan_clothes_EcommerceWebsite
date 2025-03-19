@extends('admin')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="userName">Name:</label>
            <input type="text" id="userName" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="userEmail">Email:</label>
            <input type="email" id="userEmail" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="userRole">Role:</label>
            <select id="userRole" name="role" class="form-control">
                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Support" {{ $user->role == 'Support' ? 'selected' : '' }}>Support</option>
                <option value="Customer" {{ $user->role == 'Customer' ? 'selected' : '' }}>Customer</option>
                <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User</option>
            </select>
        </div>
        <div class="form-group">
            <label for="userStatus">Status:</label>
            <select id="userStatus" name="status" class="form-control">
                <option value="Active" {{ $user->status == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ $user->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label for="userPassword">Password (leave blank to keep current password):</label>
            <input type="password" id="userPassword" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success mt-3">Save</button>
    </form>
</div>
@endsection
