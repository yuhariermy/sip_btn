<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_acesses = [
            [
                'id' => 1,
                'name' => 'BEYONDTRUST'
            ],
            [
                'id' => 2,
                'name' => 'USERDB'
            ],
            [
                'id' => 3,
                'name' => 'CREATEUSERVPN'
            ],
            [
                'id' => 999,
                'name' => 'OTHERS'
            ]
        ];

        DB::table('type_acesses')->insert($type_acesses);
    }
}
