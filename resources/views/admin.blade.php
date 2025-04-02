<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <!-- Add your styles CSS here -->
    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 85%;
            margin: 30px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #333;
            text-align: center;
        }

        /* Navigation Menu */
        nav ul {
            list-style-type: none;
            padding: 10px 0;
            background-color: #343a40;
            color: white;
            margin-bottom: 30px;
            border-radius: 8px;
            text-align: center;
        }

        nav ul li {
            display: inline;
            padding: 12px 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            text-transform: uppercase;
        }

        nav ul li a:hover {
            text-decoration: underline;
            background-color: #495057;
            padding: 8px 20px;
            border-radius: 5px;
        }

        /* Table Styles */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .table th, .table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .table th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
        }

        /* Button Styles */
        .btn {
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-warning {
            background-color: #ffc107;
            color: white;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Alert Styles */
        .alert {
            padding: 15px;
            background-color: #28a745;
            color: white;
            margin-bottom: 30px;
            border-radius: 5px;
            font-size: 16px;
        }

        .alert-danger {
            background-color: #dc3545;
        }

        /* Form Styles */
        form {
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-top: 5px;
        }

        .form-control:focus {
            border-color: #007bff;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .container {
                width: 95%;
            }

            nav ul li {
                display: block;
                padding: 10px;
            }
        }

    </style>

</head>
<body>
    <div class="container">
        <!-- Navigation Menu -->
        <nav>
            <ul>
                <li><a href="{{ route('products.index') }}">Product List</a></li>
                <li><a href="{{ route('users.index') }}">Users List</a></li>
                <li><a href="{{ route('orders.index') }}">Orders List</a></li> <!-- Added Orders List Link -->
                <li><a href="{{ route('home') }}">Home</a></li>
                <!-- Other links can be added here -->
            </ul>
        </nav>

        <!-- Page-specific content -->
        @yield('content')

    </div>

    <!-- Scripts can be added here -->
</body>
</html>
