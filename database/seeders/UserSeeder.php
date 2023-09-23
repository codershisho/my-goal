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
                'avatar' => 'aaa.svg',
                'password' => bcrypt('hogehoge'),
            ],
            [
                'name' => 'yoshi',
                'avatar' => 'yoshi.svg',
                'password' => bcrypt('hogehoge'),
            ],
            [
                'name' => 'yama',
                'avatar' => 'yama.svg',
                'password' => bcrypt('hogehoge'),
            ],
            [
                'name' => 'shimo',
                'avatar' => 'shimo.svg',
                'password' => bcrypt('hogehoge'),
            ],
        ]);
    }
}
