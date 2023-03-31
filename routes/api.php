<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', [BookController::class,'index']);
Route::get('/books', [BookController::class,'index']);
Route::get('/books/{isbn}', [BookController::class, 'findByISBN']);
Route::get('/books/checkisbn/{isbn}', [BookController::class, 'checkISBN']);
Route::get('/books/search/{searchTerm}', [BookController::class, 'findBySearchTerm']);

Route::post('/books', [BookController::class, 'save']);
