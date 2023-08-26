<?php

namespace Database\Seeders;

use App\Models\MTerm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * m_termsの初期データ作成
 */
class MTermsTableSeeder extends Seeder
{
    public function run()
    {
        MTerm::insert([
            ["name" => "2023年下半期", "from" => "2023-05-01", "to" => "2023-10-31"]
        ]);
    }
}
