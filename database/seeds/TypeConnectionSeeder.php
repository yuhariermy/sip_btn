<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeConnectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_connections = [
            [
                'id' => 1,
                'name' => 'H2H'
            ],
            [
                'id' => 2,
                'name' => 'PUBLIC'
            ],
            [
                'id' => 3,
                'name' => 'INTRANET'
            ],
            [
                'id' => 999,
                'name' => 'OTHERS'
            ]
        ];

        DB::table('type_connections')->insert($type_connections);
    }
}
