<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Shop - Tradition & Style')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <!-- Navigation bar starts -->
    <header class="header">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
        </a>
        <nav class="navbar">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('shop') }}">Shop</a>
            <a href="{{ route('newArrivals') }}">New Arrivals</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('contact') }}">Contact</a>

            @auth
            <a href="{{ route('orders.myOrders') }}">
                <i class="fas fa-route"></i> Track My Orders
            </a>

            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin') }}">Admin</a>
            @endif

            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
            @else
            <a href="{{ route('login') }}">
                <div class="fas fa-user" id="user-btn"></div>
            </a>
            @endauth
        </nav>

        <div class="icons">
            <div class="fas fa-search" id="search-btn"></div>
            <a href="{{ route('cart.index') }}"><div class="fas fa-shopping-cart" id="cart-btn"></div></a>
            <a href="{{ route('login') }}"><div class="fas fa-user" id="user-btn"></div></a>
        </div>
    </header>
    <!-- Navigation bar ends -->

    <!-- Main content section -->
    <main>
        @yield('content')
    </main>

    <!-- Footer section starts -->
    <footer class="footer">
        <div class="box-container">
            <div class="box">
                <h3>QUICK LINKS</h3>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('shop') }}">Shop</a>
                <a href="{{ route('newArrivals') }}">New Arrivals</a>
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
            <div class="box">
                <h3>CUSTOMER SUPPORT</h3>
                <a href="#">Customer Service</a>
                <a href="#">Store Locator</a>
                <a href="#">Disclaimer</a>
                <a href="#">Delivery</a>
                <a href="#">Exchange</a>
                <a href="#">FAQs</a>
            </div>
            <div class="box">
                <h3>MORE FROM Tradition & Style</h3>
                <a href="{{ route('about') }}">About Us</a>
                <a href="{{ route('contact') }}">Contact Us</a>
                <a href="{{ route('home') }}">Blogs</a>
            </div>
            <div class="box">
                <h3>GET IN TOUCH</h3>
                <p><i class="fas fa-phone"></i> +2126528631</p>
                <p><i class="fas fa-envelope"></i> TraditionStyle.com</p>
                <p>GET THE LATEST NEWS</p>
                <form id="newsletter-form">
                    <input type="email" id="newsletter-email" placeholder="Email Address" required>
                    <button type="submit">CONFIRM</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="secure-checkout">
                <p>100% Safe Checkout</p>
                <img src="{{ asset('images/mastercard-logo.png') }}" alt="MasterCard" style="width: 200px; height: 70px;">
            </div>
            <div class="secured-by">
                <p>Secured by</p>
                <img src="{{ asset('images/security-logo.png') }}" alt="Security Logo" style="width: 200px; height: 50px;">
            </div>
        </div>
        <div class="credit"> created by <span>Tradition & Style</span> | all rights reserved </div>
    </footer>
    <!-- Footer section ends -->

    <!-- JavaScript -->
    <script>
    document.getElementById('newsletter-form').addEventListener('submit', function(event) {
        event.preventDefault();

        let email = document.getElementById('newsletter-email').value;

        fetch("{{ route('subscribe') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token']").getAttribute('content')
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                title: "Subscription Successful!",
                text: data.success,
                icon: "success",
                confirmButtonText: "OK"
            });
            document.getElementById('newsletter-email').value = "";
        })
        .catch(error => {
            Swal.fire({
                title: "Error",
                text: "This email is already registered or invalid.",
                icon: "error",
                confirmButtonText: "OK"
            });
        });
    });
    </script>

</body>
</html>
