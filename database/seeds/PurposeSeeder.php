<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $purposes = [
            [
                'name' => 'ADD'
            ],
            [
                'name' => 'MODIFY'
            ],
            [
                'name' => 'DELETE'
            ],
            [
                'name' => 'TEMPORARY'
            ],
            [
                'name' => 'PERMANENT'
            ]
        ];

        DB::table('purposes')->insert($purposes);
    }
}
