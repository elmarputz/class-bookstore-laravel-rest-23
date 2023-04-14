<?php

namespace App\Http\Controllers;
use App\Models\Author;
use App\Models\Book;
use App\Models\Image;
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

            if (isset($request['authors']) && is_array($request['authors'])) {
                foreach ($request['authors'] as $author) {
                    $author = Author::firstOrNew([
                       'firstName' => $author['firstName'],
                       'lastName' => $author['lastName']
                    ]);
                    $book->authors()->save($author);
                }

            }


            if (isset($request['images']) && is_array($request['images'])) {
                foreach ($request['images'] as $image) {
                    $image = Image::firstOrNew([
                        'url' => $image['url'],
                        'title' => $image['title']
                    ]);
                    $book->images()->save($image);
                }

            }

            DB::commit();
            return response()->json($book, 200);
        }

        catch (\Exception $e) {

            DB::rollBack();
            return response()->json("saving book failed: " . $e->getMessage(), 420);
        }


    }


  public function update(Request $request, string $isbn) : JsonResponse
{

   DB::beginTransaction();
   try {
       $book = Book::with(['authors', 'images', 'user'])
           ->where('isbn', $isbn)->first();
       if ($book != null) {
           $request = $this->parseRequest($request);
           $book->update($request->all());

           //delete all old images
           $book->images()->delete();
           // save images
           if (isset($request['images']) && is_array($request['images'])) {
               foreach ($request['images'] as $img) {
                   $image = Image::firstOrNew(['url'=>$img['url'],'title'=>$img['title']]);
                   $book->images()->save($image);
               }
           }
           //update authors

           $ids = [];
           if (isset($request['authors']) && is_array($request['authors'])) {
               foreach ($request['authors'] as $auth) {
                   array_push($ids,$auth['id']);
               }
           }
           $book->authors()->sync($ids);
           $book->save();

       }
       DB::commit();
       $book1 = Book::with(['authors', 'images', 'user'])
           ->where('isbn', $isbn)->first();
       // return a vaild http response
       return response()->json($book1, 201);
   }
   catch (\Exception $e) {
       // rollback all queries
       DB::rollBack();
       return response()->json("updating book failed: " . $e->getMessage(), 420);
   }
}

    
    public function delete(string $isbn) : JsonResponse {
       $book = Book::where('isbn', $isbn)->first();
       if ($book != null) {
           $book->delete();
           return response()->json('book (' . $isbn . ') successfully deleted', 200);
       }
       else
           return response()->json('book could not be deleted - it does not exist', 422);
      }
 }



    private function parseRequest(Request $request) : Request {

        // convert date
        $date = new \DateTime($request->published);
        $request['published'] = $date;
        return $request;

    }
}
