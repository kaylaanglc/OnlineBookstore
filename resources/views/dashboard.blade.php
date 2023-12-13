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
            <!-- Books List -->
            <section class="mx-20 mb-4">
                <div class="grid grid-flow-row grid-cols-2 items-center gap-5">
                    @foreach ($books as $book)
                        <x-book-card :book="$book" />
                    @endforeach
                </div>
                <div class="mt-10 bg-white p-4 rounded-md bg-opacity-60">
                    {{ $books->links() }}
                </div>
            </section>
        </div>
        
        <footer class="bg-white rounded-lg shadow dark:bg-gray-900">
            <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">&copy; {{ date('Y') }} CCKK Online Bookstore. All rights reserved.</span>
            </div>
        </footer>
    </div>
</x-app-layout>
