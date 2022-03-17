<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('users')->insert([
            'name' => 'Yousief Mohamed',
            'user_name' => 'yousief784',
            'email' => 'admin@admin.com',
            'phone' => '01067762979',
            'user_type' => 'top_admin',
            'password' => Hash::make('password'),
        ]);
    }
}
