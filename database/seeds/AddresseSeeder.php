<?php

use Illuminate\Database\Seeder;

class AddresseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Address::class, 50)->create();
    }
}
