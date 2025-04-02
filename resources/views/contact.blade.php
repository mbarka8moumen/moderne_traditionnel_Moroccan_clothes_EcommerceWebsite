@extends('layout')

@section('title', 'Contact')

@section('content')

@guest
    <script>window.location.href = "{{ route('login') }}";</script>
@else
<section class="contact" id="contact">
    <div class="container">
        <h1 class="heading">Contact Us</h1>

        @if(session('success'))
            <script>
                Swal.fire({
                    title: "Message Sent!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK",
                    timer: 5000,
                    timerProgressBar: true
                });
            </script>
        @endif

        <div class="box-container">
            <div class="box contact-info">
                <h3>Our Contact Details</h3>
                <p>We are here to help. Feel free to contact us for any questions.</p>
                <p><i class="fas fa-phone"></i> +2126528631</p>
                <p><i class="fas fa-envelope"></i> TraditionStyle.com</p>
            </div>
            <div class="box follow-us">
                <h3>Follow Us</h3>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
            </div>
            <div class="box contact-form">
                <h3>Send Us a Message</h3>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Your Name" required value="{{ old('name') }}">
                    <input type="email" name="email" placeholder="Your Email" required value="{{ old('email') }}">
                    <input type="tel" name="phone" placeholder="Your Phone Number" required value="{{ old('phone') }}">
                    <textarea name="message" rows="5" placeholder="Your Message" required>{{ old('message') }}</textarea>
                    <button type="submit" class="btn">Send</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endguest

@endsection
