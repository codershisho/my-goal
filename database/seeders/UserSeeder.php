<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'aaa',
                'department' => 1,
                'role' => 'default',
                'avatar' => 'aaa.svg',
                'password' => bcrypt('hogehoge'),
            ],
            [
                'name' => 'yoshi',
                'department' => 1,
                'role' => 'admin',
                'avatar' => 'yoshi.svg',
                'password' => bcrypt('hogehoge'),
            ],
            [
                'name' => 'yama',
                'department' => 1,
                'role' => 'admin',
                'avatar' => 'yama.svg',
                'password' => bcrypt('hogehoge'),
            ],
            [
                'name' => 'shimo',
                'department' => 1,
                'role' => 'admin',
                'avatar' => 'shimo.svg',
                'password' => bcrypt('hogehoge'),
            ],
            [
                'name' => 'taru',
                'department' => 2,
                'role' => 'default',
                'avatar' => 'aaa.svg',
                'password' => bcrypt('hogehoge'),
            ],
        ]);
    }
}
