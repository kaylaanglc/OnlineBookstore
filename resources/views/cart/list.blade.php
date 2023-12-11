<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shopping Cart</title>
    <!-- Add your stylesheets and scripts if needed -->
</head>
<body>
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-semibold mb-4">Shopping Cart</h2>

        @if(count($cartItems) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($cartItems as $cartItem)
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-md shadow-md">
                        <h3 class="text-lg font-semibold mb-2">{{ $cartItem->book->title }}</h3>
                        <p>Author: {{ $cartItem->book->author }}</p>
                        <p>ISBN: {{ $cartItem->book->ISBN }}</p>
                        <p>Price: ${{ number_format($cartItem->book->price, 2) }}</p>
                        <p>Quantity: {{ $cartItem->quantity }}</p>
                        <p>Subtotal: ${{ number_format($cartItem->quantity * $cartItem->book->price, 2) }}</p>
                        {{-- Add more details as needed --}}
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                <h3 class="text-xl font-semibold mb-2">Total Price: ${{ number_format($totalPrice, 2) }}</h3>
                {{-- You may want to format the total price according to your requirements --}}
            </div>
            <button class="bg-blue-500 text-white px-4 py-2 rounded-md" onclick="window.location.href='/order'">Proceed to Checkout</button>
            @else
            <p>Your cart is empty.</p>
        @endif
    </div>


</body>
</html>

