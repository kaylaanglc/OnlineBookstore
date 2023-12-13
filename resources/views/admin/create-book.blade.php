<x-app-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Use 'Edit' for edit mode and create for non-edit/create mode --}}
            {{ isset($book) ? 'Edit' : 'Create' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- don't forget to add multipart/form-data so we can accept file in our form --}}
                    <form method="post" action="{{ isset($book) ? route('admin.update', $book->id) : route('admin.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        {{-- add @method('put') for edit mode --}}
                        @isset($book)
                            @method('put')
                        @endisset

                        <div>
                            <x-input-label for="title" value="Title" class="dark:text-gray-300"/>
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="$book->title ?? old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="author" value="Author" />
                            <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" :value="$book->author ?? old('author')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('author')" />
                        </div>

                        <div>
                            <x-input-label for="ISBN" value="ISBN" />
                            <x-text-input id="ISBN" name="ISBN" type="text" class="mt-1 block w-full" :value="$book->ISBN ?? old('ISBN')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('ISBN')" />
                        </div>

                        <div>
                            <x-input-label for="price" value="Price" />
                            <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" :value="$book->price ?? old('price')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        <div>
                            <x-input-label for="image" value="Image" />
                            <label class="block mt-2">
                                <span class="sr-only">Choose image</span>
                                <input type="file" id="image" name="image" class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-violet-50 file:text-violet-700
                                    hover:file:bg-violet-100
                                "/>
                            </label>
                            <div class="shrink-0 my-2">
                                <img id="image_preview" class="h-64 w-128 object-cover rounded-md" src="{{ isset($book) ? Storage::url($book->image) : '' }}" alt="Featured image preview" />
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // create onchange event listener for image input
        document.getElementById('image').onchange = function(evt) {
            const [file] = this.files
            if (file) {
                // if there is an image, create a preview in image_preview
                document.getElementById('image_preview').src = URL.createObjectURL(file)
            }
        }
    </script>
</x-app-admin-layout>
