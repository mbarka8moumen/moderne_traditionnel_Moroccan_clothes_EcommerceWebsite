@extends('admin')

@section('content')
<div class="container">
    <h1>Add a New User</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="userName">Name:</label>
            <input type="text" id="userName" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="userEmail">Email:</label>
            <input type="email" id="userEmail" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="userPassword">Password:</label>
            <input type="password" id="userPassword" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="userRole">Role:</label>
            <select id="userRole" name="role" class="form-control">
                <option value="Admin">Admin</option>
                <option value="Support">Support</option>
                <option value="Customer">Customer</option>
                <option value="User" selected>User</option>
            </select>
        </div>

        <div class="form-group">
            <label for="userStatus">Status:</label>
            <select id="userStatus" name="status" class="form-control">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save</button>
    </form>
</div>
@endsection
