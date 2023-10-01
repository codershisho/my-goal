<?php

namespace Database\Seeders;

use App\Models\MTopic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * m_topicsの初期データ作成
 */
class MTopicsTableSeeder extends Seeder
{
    public function run()
    {
        MTopic::insert([
            ["name" => "業務の進め方や進捗", "sort" => 1],
            ["name" => "人間関係", "sort" => 2],
            ["name" => "心身の状態", "sort" => 3],
            ["name" => "今後のキャリア", "sort" => 4],
            ["name" => "スキルや力の向上", "sort" => 5],
            ["name" => "プライベート", "sort" => 6],
            ["name" => "会社や部署の方針", "sort" => 7],
            ["name" => "その他", "sort" => 8],
            ["name" => "今回のミーティング全体を通して", "sort" => 9],
        ]);
    }
}
