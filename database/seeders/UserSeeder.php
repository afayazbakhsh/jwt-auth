<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([

            'email' => 'amirfz878787@gmail.com',
            'password' => Hash::make('amir8787')
        ]);

        $user->posts()->create([
            'title' => 'post1',
            'description' => 'post desc'
        ]);
    }
}
