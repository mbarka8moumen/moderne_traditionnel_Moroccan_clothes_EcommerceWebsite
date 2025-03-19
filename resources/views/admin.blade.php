<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <!-- Add your styles CSS here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #333;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            background-color: #343a40;
            color: white;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        nav ul li {
            display: inline;
            padding: 10px 20px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .btn {
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            border: none;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-warning {
            background-color: #ffc107;
            color: white;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .alert {
            padding: 10px;
            background-color: #28a745;
            color: white;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-danger {
            background-color: #dc3545;
        }
        form {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .form-control:focus {
            border-color: #007bff;
        }
    </style>

</head>
<body>
    <div class="container">
        <!-- Navigation Menu -->
        <nav>
            <ul>
                <li><a href="{{ route('products.index') }}">Product List</a></li>
                <li><a href="{{ route('users.index') }}">usersList</a></li>
                <li><a href="{{ route('home') }}">home</a></li>

                <!-- Other links can be added here -->
            </ul>
        </nav>

        <!-- Page-specific content -->
        @yield('content')
    </div>

    <!-- Scripts can be added here -->
</body>
</html>
