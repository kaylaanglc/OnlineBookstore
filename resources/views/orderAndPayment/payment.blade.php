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
            <h1 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white flex justify-center">Payment</h1>

            <form action="{{ route('process.payment') }}" method="post" class="max-w-sm mx-auto">
                @csrf

                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div>
                        <label for="name">Name: {{ $currentOrder->name }}</label>
                    </div>

                    <div>
                        <label for="totalPrice">Total Price: ${{ $totalPrice }}</label>
                    </div>

                    {{-- <div>
                        <label for="amount">Amount:</label>
                        <input type="text" name="amount" value="{{ $totalPrice }}" readonly>
                    </div> --}}

                    <div>
                        <label for="paymentMethod" >Payment Method:</label>
                        <select name="paymentMethod" id="paymentMethod" class="bg-gray-50 mb-5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($paymentMethods as $method)
                                <option value="{{ $method->id }}">{{ $method->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary rounded-full text-white bg-blue-400 w-1/2">Submit Payment</button>
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
