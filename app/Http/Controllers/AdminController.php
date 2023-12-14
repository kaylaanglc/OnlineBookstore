<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
// We will use Form Request to validate incoming requests from our store and update method
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->view('admin.books', [
            'books' => Book::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('admin.create-book');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // if ($request->hasFile('image')) {
        //      // put image in the public storage
        //     $filePath = Storage::disk('public')->put('images/books', request()->file('image'));
        //     $validated['image'] = $filePath;
        // }

        // if ($request->hasFile('image')) {
        //     // put image in the public/images/books directory
        //     $filePath = $request->file('image')->store('images/books', 'public');

        //     // adjust the storage path in the database if needed
        //     $validated['image'] = $filePath;
        // }

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Move the file to the public/images/books directory with its original name
            $file->storeAs(public_path('images/books'), $file->getClientOriginalName());

            // Set the image path for database storage
            $validated['image'] = $file;
        }

        // insert only requests that already validated in the StoreRequest
        $create = Book::create($validated);

        if($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'Book created successfully!');
            return redirect()->route('admin.index');
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return response()->view('admin.show-book', [
            'book' => Book::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        return response()->view('admin.create-book', [
            'book' => Book::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $book = Book::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // delete image
            Storage::disk('public')->delete($book->image);

            $filePath = Storage::disk('public')->put('images/books', request()->file('image'), 'public');
            $validated['image'] = $filePath;
        }

        $update = $book->update($validated);

        if($update) {
            session()->flash('notif.success', 'Book updated successfully!');
            return redirect()->route('admin.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $book = Book::findOrFail($id);

        Storage::disk('public')->delete($book->image);

        $delete = $book->delete($id);

        if($delete) {
            session()->flash('notif.success', 'Book deleted successfully!');
            return redirect()->route('admin.index');
        }

        return abort(500);
    }
}
