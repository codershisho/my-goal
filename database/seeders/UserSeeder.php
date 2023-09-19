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
                'email' => 'aaa@example.com',
                'password' => bcrypt('hogehoge'),
            ],
            [
                'name' => 'yoshi',
                'email' => 'bbb@example.com',
                'password' => bcrypt('hogehoge'),
            ],
            [
                'name' => 'aku',
                'email' => 'ccc@example.com',
                'password' => bcrypt('hogehoge'),
            ],
            [
                'name' => 'kuma',
                'email' => 'ddd@example.com',
                'password' => bcrypt('hogehoge'),
            ],
            [
                'name' => 'taru',
                'email' => 'eee@example.com',
                'password' => bcrypt('hogehoge'),
            ],
            [
                'name' => 'yama',
                'email' => 'fff@example.com',
                'password' => bcrypt('hogehoge'),
            ],
            [
                'name' => 'shimo',
                'email' => 'ggg@example.com',
                'password' => bcrypt('hogehoge'),
            ],
        ]);
    }
}
