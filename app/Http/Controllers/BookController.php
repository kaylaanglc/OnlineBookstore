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

    public function map(Request $request)
    {
        $perPage = 10;
        $sortField = $request->input('sort_by', 'default');

        $booksQuery = Book::query();

        // Apply sorting based on the selected criteria
        switch ($sortField) {
            case 'price_low_high':
                $booksQuery->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $booksQuery->orderBy('price', 'desc');
                break;
            case 'title':
                $booksQuery->orderBy('title', 'asc');
                break;
            case 'author':
                $booksQuery->orderBy('author', 'asc');
                break;
            default:
                // You can define your default sorting here
                break;
        }

        $books = $booksQuery->paginate($perPage);

        return view('dashboard', compact('books'));
    }
}
