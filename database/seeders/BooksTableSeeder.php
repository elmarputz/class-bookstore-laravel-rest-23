<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Image;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $book = new Book();
        $book->isbn = '34534534869';
        $book->title = Str::random(50);
        $book->subtitle = Str::random(100);
        $book->rating = 10;
        $book->published = new DateTime();
        $book->description = Str::random(200);
        $book->created_at = date("Y-m-d H:i:s");
        $book->updated_at = date("Y-m-d H:i:s");

        // get user
        $user = User::first();
        $book->user()->associate($user);
        $book->save();

        // add images
        $image1 = new Image();
        $image1->url = 'https://m.media-amazon.com/images/I/51A9DYVP3gL._SY264_BO1,204,203,200_QL40_ML2_.jpg';
        $image1->title = 'Harry Potter 1 Cover';

        $image2 = new Image();
        $image2->url = 'https://m.media-amazon.com/images/I/51A9DYVP3gL._SY264_BO1,204,203,200_QL40_ML2_.jpg';
        $image2->title = 'Harry Potter 2 Cover';
        $book->images()->saveMany([$image1, $image2]);

        // get all author ids
        $authors = Author::all()->pluck("id");
        $book->authors()->sync($authors);
        $book->save();

        $book1 = new Book();
        $book1->isbn = '34534534863';
        $book1->title = Str::random(50);
        $book1->subtitle = Str::random(100);
        $book1->rating = 10;
        $book1->published = new DateTime();
        $book1->description = Str::random(200);
        $book1->created_at = date("Y-m-d H:i:s");
        $book1->updated_at = date("Y-m-d H:i:s");
        $book1->user()->associate($user);
        $book1->save();

        $book2 = new Book();
        $book2->isbn = '567856785678675';
        $book2->title = Str::random(50);
        $book2->subtitle = Str::random(100);
        $book2->rating = 10;
        $book2->published = new DateTime();
        $book2->description = Str::random(200);
        $book2->created_at = date("Y-m-d H:i:s");
        $book2->updated_at = date("Y-m-d H:i:s");
        $book2->user()->associate($user);
        $book2->save();


    }
}
