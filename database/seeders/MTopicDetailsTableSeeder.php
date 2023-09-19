<?php

namespace Database\Seeders;

use App\Models\MTopicDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * m_topic_detailsの初期データ作成
 */
class MTopicDetailsTableSeeder extends Seeder
{
    public function run()
    {
        MTopicDetail::insert([
            ["name" => "具体的なアドバイスがほしい"],
            ["name" => "一緒に考えてほしい"],
            ["name" => "話を聞いてほしい"],
            ["name" => "意見を聞きたい"],
            ["name" => "報告したい"],
            ["name" => "その他"],
        ]);
    }
}
