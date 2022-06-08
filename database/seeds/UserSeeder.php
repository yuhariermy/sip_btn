<?php

use Illuminate\Database\Seeder;
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
        $users = [
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'is_role' => 1
            ],
            [
                'name' => 'Demo Staff',
                'username' => 'demostaff',
                'email' => 'demostaff@gmail.com',
                'password' => Hash::make('demostaff'),
                'is_role' => 2
            ],
            [
                'name' => 'Demo CMT',
                'username' => 'democmt',
                'email' => 'democmt@gmail.com',
                'password' => Hash::make('democmt'),
                'is_role' => 3
            ],
            [
                'name' => 'Demo Quality Assurance',
                'username' => 'demoqa',
                'email' => 'demoqa@gmail.com',
                'password' => Hash::make('demoqa'),
                'is_role' => 4
            ],
            [
                'name' => 'DEMO IT Security',
                'username' => 'demoits',
                'email' => 'demoits@gmail.com',
                'password' => Hash::make('demoits'),
                'is_role' => 5
            ]
        ];
        DB::table('users')->insert($users);
    }
}
