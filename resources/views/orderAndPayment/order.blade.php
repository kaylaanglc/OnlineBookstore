<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Order Form</title>
    <!-- Add your stylesheets and scripts if needed -->
</head>
<body>
    <div class="container">
        <h2>Order Information</h2>

        {{-- Display error messages if there are any --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('continue-to-payment') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>
            <div class="mt-8">
                <h3 class="text-xl font-semibold mb-2">Total Price: ${{ number_format($totalPrice, 2) }}</h3>
                {{-- You may want to format the total price according to your requirements --}}
            </div>
            <button type="submit" class="btn btn-primary">Continue to Payment</button>
        </form>
    </div>
</body>
</html>
