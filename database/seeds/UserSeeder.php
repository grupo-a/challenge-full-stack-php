<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'api_token' => 'kP6g4NQ7wkxXo31xqzjJ1lmoc71RnZNEu8XZSTzjU2bVmuqdWRo2gzUsI1dI',
            'created_at' => Carbon::now()
        ]);
    }
}
