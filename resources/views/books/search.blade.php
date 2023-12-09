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
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="mt-16 mb-8">
            <div class="grid grid-cols-2 gap-3">
                @if(count($books) > 0)
                    @foreach($books as $book)
                        <div class="col-span-2 bg-white dark:bg-gray-800 shadow p-4 rounded-md w-full md:w-1/2 lg:w-1/2">
                            <h2 style="color: {{ config('app.theme') === 'dark' ? 'black' : 'white' }}">{{ $book->title }}</h2>
                            <p style="color: {{ config('app.theme') === 'dark' ? 'black' : 'white' }}">Author: {{ $book->author }}</p>
                            <p style="color: {{ config('app.theme') === 'dark' ? 'black' : 'white' }}">ISBN: {{ $book->isbn }}</p>
                            <p style="color: {{ config('app.theme') === 'dark' ? 'black' : 'white' }}">Price: {{ $book->price }}</p>
                        </div>
                    @endforeach
                @else
                    <p style="color: {{ config('app.theme') === 'dark' ? 'black' : 'white' }}">No books found</p>
                @endif
            </div>
        </main>

        <!-- Footer Section -->
        <footer class="bg-gray-800 text-white p-4 text-center">
            <p>&copy; {{ date('Y') }} CCKK Online Bookstore. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
