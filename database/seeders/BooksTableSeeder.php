<?php

namespace Database\Seeders;

use App\Models\Book;
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

        $book = Book();
        $book->isbn = '3453453453534';
        $book->title = Str::random(50);
        $book->subtitle = Str::random(100);
        $book->rating = 10;
        $book->published = new DateTime();
        $book->description = Str::random(200);
        $book->created_at = date("Y-m-d H:i:s");
        $book->updated_at = date("Y-m-d H:i:s");
        $book->save();

        $book1 = new Book();
        $book1->isbn = '35463424352345';
        $book1->title = Str::random(50);
        $book1->subtitle = Str::random(100);
        $book1->rating = 10;
        $book1->published = new DateTime();
        $book1->description = Str::random(200);
        $book1->created_at = date("Y-m-d H:i:s");
        $book1->updated_at = date("Y-m-d H:i:s");
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
        $book2->save();


    }
}
