<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Abod',
            'email' => 'abod@gmail.com',
            'usertype' => 1,
            'phone' => '1234567890',
            'address' => '123 Admin Street',
            'password' => Hash::make('123'), // Use a secure password
        ]);
    }
}
