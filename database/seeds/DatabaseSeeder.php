<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LocationSeeder::class);
        $this->call(PurposeSeeder::class);
        $this->call(TypeAccessSeeder::class);
        $this->call(TypeConnectionSeeder::class);
        $this->call(UserSeeder::class);
    }
}
