<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('title');
        $books = $query = $request->input('title');
        $books = Book::where('title', 'like', "%$query%")
                ->orWhere('author', 'like', "%$query%")
                ->orWhere('isbn', 'like', "%$query%")
                ->orWhere('price', 'like', "%$query%")
                ->get();

        return view('books.search', compact('books'));
    }
}
