<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cart;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => '12345'
        ]);

        $user2 = User::create([
            'name' => 'Jane Doe',
            'email' => 'janedoe@gmail.com',
            'password' => '23456'
        ]);

        Cart::create([
            'user_id' => $user1->id
        ]);

        Cart::create([
            'user_id' => $user2->id
        ]);
    }
}
