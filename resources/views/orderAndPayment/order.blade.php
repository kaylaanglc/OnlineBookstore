<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <title>Order Form</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased h-screen overflow-y-auto m-0">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 text-white">
        <h2 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white flex justify-center">Order Information</h2>

        {{-- Display error messages if there are any --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('continue-to-payment') }}" method="post" class="max-w-sm mx-auto">
            @csrf
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="bg-gray-50 mb-5 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="bg-gray-50 mb-5 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="youmail@mail.com" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" name="phone" class="bg-gray-50 mb-5 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="phone number" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address" class="bg-gray-50 mb-5 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="address" required></textarea>
            </div>
            <div class="mt-8">
                <h3 class="text-xl font-semibold mb-2">Total Price: ${{ number_format($totalPrice, 2) }}</h3>
                {{-- You may want to format the total price according to your requirements --}}
            </div>
            <button type="submit" class="btn btn-primary rounded-full text-white bg-blue-400 w-1/2">Continue to Payment</button>
        </div>
        </form>

        <footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4 bottom-0">
            <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">&copy; {{ date('Y') }} CCKK Online Bookstore. All rights reserved.</span>
            </div>
        </footer>
    </div>
</body>
</html>
