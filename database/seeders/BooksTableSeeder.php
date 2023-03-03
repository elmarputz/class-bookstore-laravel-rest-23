<?php

namespace Database\Seeders;

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
        DB::table('books')->insert([
            'isbn' => '239487294872349',
            'title'=> Str::random(50),
            'subtitle' => Str::random(100),
            'rating' => 10,
            'published' => new DateTime(),
            'description' => Str::random(200),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('books')->insert([
            'isbn' => '42342342243243',
            'title'=> Str::random(50),
            'subtitle' => Str::random(100),
            'rating' => 10,
            'published' => new DateTime(),
            'description' => Str::random(200),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('books')->insert([
            'isbn' => '234234243423243',
            'title'=> Str::random(50),
            'subtitle' => Str::random(100),
            'rating' => 10,
            'published' => new DateTime(),
            'description' => Str::random(200),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

    }
}
