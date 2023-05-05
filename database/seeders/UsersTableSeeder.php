<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "testuser";
        $user->email = "test@test.at";
        $user->role = "admin";
        $user->password = bcrypt('secret');
        $user->save();

        $user2 = new User();
        $user2->name = "testuser2";
        $user2->email = "test2@test2.at";
        $user2->role = "user";
        $user2->password = bcrypt('secret');
        $user2->save();

    }
}
