<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function checkISBN (string $isbn) : JsonResponse {
        $book = Book::where('isbn', $isbn)->first();
        return $book != null ? response()->json(true, 200) : response()->json(false, 200);
    }

    public function findBySearchTerm (string $searchTerm) : JsonResponse {
        $books = Book::with(['authors', 'images', 'user'])
            ->where('title', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('subtitle', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
            ->orWhereHas('authors', function($query) use ($searchTerm){
                $query->where('firstName', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('lastName', 'LIKE',  '%' . $searchTerm . '%');
            })->get();
        return response()->json($books, 200);

    }

    /**
     * save a new book
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request) : JsonResponse {


        $request = $this->parseRequest($request);
        DB::beginTransaction();

        try {
            $book = Book::create($request->all());
            DB::commit();
            return response()->json($book, 200);
        }

        catch (\Exception $e) {

            DB::rollBack();
            return response()->json("saving book failed: " . $e->getMessage(), 420);
        }


    }


    private function parseRequest(Request $request) : Request {

        // convert date
        $date = new \DateTime($request->published);
        $request['published'] = $date;
        return $request;

    }
}
