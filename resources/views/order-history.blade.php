<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-screen">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased h-screen overflow-y-auto m-0 text-white">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        {{-- Page Content --}}
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white flex justify-center mt-5">Order History</h2>

@if($orders->isEmpty())
    <p>No orders found.</p>
@else
    <ul>
        @foreach($orders as $order)
            <li class="mb-4 ml-10 mt-2">
                <strong>Order ID:</strong> {{ $order->id }}<br>

                <!-- Display other order information as needed -->
                <strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}<br>
                <strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d H:i:s') }}<br>

                <!-- Additional information for each item in the order -->
                @foreach($order->items as $item)
                    <strong>Book Title:</strong> {{ $item->book_title }}<br>
                    <strong>Quantity:</strong> {{ $item->quantity }}<br>
                    <strong>Total Price:</strong> ${{ number_format($item->total_price, 2) }}<br>
                    <strong>Author:</strong> {{ $item->author }}<br>
                    <!-- Add any other necessary fields to display -->
                @endforeach

            </li>
        @endforeach
    </ul>
@endif

<!-- Footer Section -->
<footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4 bottom-0">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">&copy; {{ date('Y') }} CCKK Online Bookstore. All rights reserved.</span>
    </div>
</footer>
    </div>

    {{-- <!-- Add your scripts here if needed -->
    <!-- For example: -->
    <script src="{{ asset('js/app.js') }}"></script> --}}
</body>
</html>
