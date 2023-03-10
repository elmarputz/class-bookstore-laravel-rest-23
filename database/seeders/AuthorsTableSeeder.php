<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = new Author();
        $author1->firstName = "Fritz";
        $author1->lastName = "Mayer";
        $author1->save();

        $author2 = new Author();
        $author2->firstName = "Susi";
        $author2->lastName = "Huber";
        $author2->save();

        $author3 = new Author();
        $author3->firstName = "Franz";
        $author3->lastName = "Berger";
        $author3->save();
    }
}
