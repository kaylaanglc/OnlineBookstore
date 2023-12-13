<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex flex-col min-h-screen">
        <div class="flex flex-col gap-10">
            @if (session('success'))
                <div class="mx-20 mt-4 animate-out fade-out delay-300 disappear-animation">
                    <x-bladewind.alert shade="dark" type="success" show_close_icon="false">
                        {{ session('success') }}
                    </x-bladewind.alert>
                </div>
            @endif
            <section class="mx-20 mb-4">
                {{-- Sorting Filter --}}
                <div class="mt-5 mb-5">
                    <form action="{{ route('dashboard') }}" method="get">
                        <label for="sort_by" class="mr-2 text-white ">Sort by:</label>
                        <select name="sort_by" id="sort_by" onchange="this.form.submit()" class="bg-gray-50 mb-5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="default" {{ request('sort_by') == 'default' ? 'selected' : '' }}>Default</option>
                            <option value="price_low_high" {{ request('sort_by') == 'price_low_high' ? 'selected' : '' }}>Price - Low to High</option>
                            <option value="price_high_low" {{ request('sort_by') == 'price_high_low' ? 'selected' : '' }}>Price - High to Low</option>
                            <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Title</option>
                            <option value="author" {{ request('sort_by') == 'author' ? 'selected' : '' }}>Author</option>
                        </select>
                    </form>
                </div>
                {{-- Books List --}}
                <div class="grid grid-flow-row grid-cols-2 items-center gap-5">
                    @foreach ($books as $book)
                        <x-book-card :book="$book" />
                    @endforeach
                </div>
                {{-- Pagination Link --}}
                <div class="mt-10 bg-white p-4 rounded-md bg-opacity-60">
                    {{ $books->appends(['sort_by' => request('sort_by')])->links() }}
                </div>
            </section>
        </div>

        <footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4 bottom-0">
            <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">&copy; {{ date('Y') }} CCKK Online Bookstore. All rights reserved.</span>
            </div>
        </footer>
    </div>
</x-app-layout>
