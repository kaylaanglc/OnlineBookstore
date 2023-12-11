@props(['book'])
<x-bladewind.card reduce_padding="true" class="cursor-pointer hover:scale-105 hover:transition hover:delay-100">
    <div class="flex items-center">
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
            <x-bladewind.avatar size="big" image="{{ $imageUrl }}"/>
        </div>
        <div class="grow pl-2 pt-1">
            <b class="text-lg">{{ $book->title }}</b>
            <div class="">
                <x-bladewind.tag label="{{ $book->author }}" color="blue"/>
            </div>
        </div>
        <div>
            {{-- <a href="{{ route('games.show', ['id' => $book->id]) }}"> --}}
            {{-- <a href="{{ route('cart.list') }}" class="text-gray-800 dark:text-white"> --}}
                <x-bladewind.button radius="medium" icon="arrow-small-right" icon_right="true" color="blue">
                    Add to Cart
                </x-bladewind.button>
            </a>
        </div>
    </div>
</x-bladewind.card>
