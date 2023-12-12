<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
<body class="font-sans antialiased ">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Content -->
        <h2 class="text-white text-2xl font-semibold mb-4 mt-2 pl-5">Shopping List</h2>
        <div class="grid grid-cols-2 gap-3 mb-2">
            @if(count($cartItems) > 0)
                <ul class="flex flex-col space-y-4">
                    @foreach($cartItems as $cartItem)
                        <x-bladewind.card reduce_padding="true" class="dark:bg-gray-800">
                            <div class="flex items-center justify-between">
                                <div class="grow pl-2 pt-1">
                                    <h3 class="text-white text-lg font-semibold mb-2">{{ $cartItem->book->title }}</h3>
                                    <ul class="text-white list-none p-0 text-sm">
                                        <li>Author: {{ $cartItem->book->author }}</li>
                                        <li>Price: ${{ number_format($cartItem->book->price, 2) }}</li>
                                    </ul>
                                </div>
                                <div class="text-white grow pl-1 pt-1">
                                    <li class="text-center">{{ $cartItem->quantity }}</li>
                                </div>
                                <div>
                                    <a href="">
                                        <button class="text-red-500 dark:text-red-500 pl-24" onclick="handleIconClick()">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                            </svg>
                                        </button>
                                    </a>
                                    <p class="text-white mt-5">Subtotal: ${{ number_format($cartItem->quantity * $cartItem->book->price, 2) }}</p>
                                </div>
                            </div>
                        </x-bladewind.card>
                    @endforeach
                </ul>
            @else
                <p>Your cart is empty.</p>
            @endif
        </div>
        
        {{-- <div class="container mx-auto mt-8">
            <h2 class="text-white text-2xl font-semibold mb-4">Shopping List</h2>
        
            @if(count($cartItems) > 0)
                <ul class="flex flex-col space-y-4">
                    @foreach($cartItems as $cartItem)
                        <li class="flex flex-col md:flex-row text-white text-lg bg-white dark:bg-gray-800 p-4 rounded-md shadow-md mb-4">
                            <div class="md:flex-grow">
                                <h3 class="text-lg font-semibold mb-2">{{ $cartItem->book->title }}</h3>
                                <ul class="list-none p-0">
                                    <li>Author: {{ $cartItem->book->author }}</li>
                                    <li>Quantity: {{ $cartItem->quantity }}</li>
                                    <li>Price: ${{ number_format($cartItem->book->price, 2) }}</li>
                                </ul> --}}
                                {{-- Add more details as needed --}}
                            {{-- </div>
                            <div class="md:flex-shrink text-right">
                                <p class="mb-2">Subtotal: ${{ number_format($cartItem->quantity * $cartItem->book->price, 2) }}</p>
                                <button class="text-red-500 dark:text-red-500" onclick="handleIconClick()">
                                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                    </svg>
                                </button>                                
                            </div>
                        </li>
                    @endforeach
                </ul>
        
                <div class="mt-8">
                    <h3 class="text-white text-xl font-semibold mb-2">Total Price: ${{ number_format($totalPrice, 2) }}</h3> --}}
                    {{-- You may want to format the total price according to your requirements --}}
                {{-- </div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md" onclick="window.location.href='/order'">Proceed to Checkout</button>
            @else
                <p>Your cart is empty.</p>
            @endif
        </div>
        
        <script>
            function handleIconClick() { --}}
                {{-- // Add your icon click functionality here --}}
                {{-- console.log('Icon clicked!');
            }
        </script> --}}
        

        <!-- Footer Section -->
        <footer class="bg-gray-800 text-white p-4 text-center">
            <p>&copy; {{ date('Y') }} CCKK Online Bookstore. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>


