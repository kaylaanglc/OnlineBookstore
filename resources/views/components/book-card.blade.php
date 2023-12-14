@props(['book'])
<x-bladewind.card reduce_padding="true" class="bg-white dark:bg-gray-800 cursor-pointer hover:scale-105 hover:transition hover:delay-100">
    <div class="flex items-center ">
        <div>
            <div class="flex-1">
                <img src={{ asset(str_replace(public_path(), '', $book->image)) }} class="mb-4 rounded-md" style="height: 200px"> <!-- Adjust the width as needed -->
            </div>
        </div>
        <div class="grow pl-2 pt-1">
            <b class="text-white text-lg">{{ $book->title }}</b>
            <p class="text-gray-500">{{ $book->author }}</p>
            <div class="">
                <x-bladewind.tag label="${{ $book->price }}" color="blue"/>
            </div>
            <b class="text-white text-italic">{{ $book->ISBN }}</b>
        </div>
        <div>
            <form action="{{ route('cart.add') }}" method="post">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button type="submit">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 19 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm1-4H5m0 0L3 4m0 0h5.501M3 4l-.792-3H1m11 3h6m-3 3V1"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</x-bladewind.card>


