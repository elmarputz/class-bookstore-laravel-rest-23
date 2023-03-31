<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() : JsonResponse {
        $books = Book::with(['authors', 'images', 'user'])->get();
        return response()->json($books, 200);
    }

    public function findByISBN (string $isbn) : JsonResponse {
        $book = Book::where('isbn', $isbn)
                ->with(['authors', 'images', 'user'])->first();
        return $book != null ? response()->json($book, 200) : response()->json(null, 200);
    }

}
