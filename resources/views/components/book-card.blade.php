@props(['book'])
<x-bladewind.card reduce_padding="true" class="bg-white dark:bg-gray-800 cursor-pointer hover:scale-105 hover:transition hover:delay-100">
    <div class="flex items-center ">
        <div>
            @php
                // Assuming $book->id is the number associated with the title in the database
                $extensions = ['jpeg', 'jpg', 'png'];
                $titleNumber = $book->id ?? $index + 1;

                $imageName = null;

                // Loop through extensions to find a valid file
                foreach ($extensions as $extension) {
                    $candidateImage = "Title{$titleNumber}.{$extension}";
                    $filePath = public_path("images/books/{$candidateImage}");

                    if (file_exists($filePath)) {
                        $imageName = $candidateImage;
                        break; // Stop the loop if a valid file is found
                    }
                }

                // Check if a valid file was found
                if ($imageName) {
                    $imageUrl = asset("images/books/$imageName");
                } else {
                    // Handle the case where no valid file was found
                    $imageUrl = null; // Or provide a default image URL or handle accordingly
                }
            @endphp
            {{-- <x-bladewind.avatar size="big" show_ring="false" image="{{ $imageUrl }}"/> --}}

            <div class="flex-1">
                <img src="{{ $imageUrl }}" class="mb-4 rounded-md" style="height: 200px"> <!-- Adjust the width as needed -->
            </div>
        </div>
        <div class="grow pl-2 pt-1">
            <b class="text-white text-lg">{{ $book->title }}</b>
            <p class="text-gray-500">{{ $book->author }}</p>
            <p class="text-gray-500">{{ $book->ISBN }}</p>
            <div class="">
                <x-bladewind.tag label="${{ $book->price }}" color="blue"/>
            </div>
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
