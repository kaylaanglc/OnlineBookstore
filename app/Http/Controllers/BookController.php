<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function search(Request $request)
{
   $query = $request->get('title');

   $books = Book::where('title', 'like', "%{$query}%")->get();

   return view('books.search', compact('books'));
}

}
