<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            [
                'name' => 'JAKARTA'
            ],
            [
                'name' => 'BANDUNG'
            ]
        ];

        DB::table('locations')->insert($locations);
    }
}
