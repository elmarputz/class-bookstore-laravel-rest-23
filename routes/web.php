<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $books =  [
        'Herr der Ringe 1',
        'Herr der Ringe 2',
        'Herr der Ringe 3',
    ];

    return view('welcome', [
        'books' => $books
    ]);
});
