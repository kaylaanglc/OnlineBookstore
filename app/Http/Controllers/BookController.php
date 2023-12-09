<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('title');
        $books = Book::where('title', 'like', '%' . $query . '%')->get();
        return view('books.search', compact('books'));
    }
}
