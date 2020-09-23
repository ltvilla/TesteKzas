<?php

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
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => ('Tiago Villa'),
            'email' => 'tiago@testekzas.com',
            'password' => bcrypt('teste'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
