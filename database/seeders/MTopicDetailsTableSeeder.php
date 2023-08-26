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
            ["topic_id" => 1, "name" => "具体的なアドバイスがほしい"],
            ["topic_id" => 1, "name" => "一緒に考えてほしい"],
            ["topic_id" => 1, "name" => "話を聞いてほしい"],
            ["topic_id" => 1, "name" => "意見を聞きたい"],
            ["topic_id" => 1, "name" => "報告したい"],
            ["topic_id" => 1, "name" => "その他"],

            ["topic_id" => 2, "name" => "具体的なアドバイスがほしい"],
            ["topic_id" => 2, "name" => "一緒に考えてほしい"],
            ["topic_id" => 2, "name" => "話を聞いてほしい"],
            ["topic_id" => 2, "name" => "意見を聞きたい"],
            ["topic_id" => 2, "name" => "報告したい"],
            ["topic_id" => 2, "name" => "その他"],

            ["topic_id" => 3, "name" => "具体的なアドバイスがほしい"],
            ["topic_id" => 3, "name" => "一緒に考えてほしい"],
            ["topic_id" => 3, "name" => "話を聞いてほしい"],
            ["topic_id" => 3, "name" => "意見を聞きたい"],
            ["topic_id" => 3, "name" => "報告したい"],
            ["topic_id" => 3, "name" => "その他"],

            ["topic_id" => 4, "name" => "具体的なアドバイスがほしい"],
            ["topic_id" => 4, "name" => "一緒に考えてほしい"],
            ["topic_id" => 4, "name" => "話を聞いてほしい"],
            ["topic_id" => 4, "name" => "意見を聞きたい"],
            ["topic_id" => 4, "name" => "報告したい"],
            ["topic_id" => 4, "name" => "その他"],

            ["topic_id" => 5, "name" => "具体的なアドバイスがほしい"],
            ["topic_id" => 5, "name" => "一緒に考えてほしい"],
            ["topic_id" => 5, "name" => "話を聞いてほしい"],
            ["topic_id" => 5, "name" => "意見を聞きたい"],
            ["topic_id" => 5, "name" => "報告したい"],
            ["topic_id" => 5, "name" => "その他"],

            ["topic_id" => 6, "name" => "具体的なアドバイスがほしい"],
            ["topic_id" => 6, "name" => "一緒に考えてほしい"],
            ["topic_id" => 6, "name" => "話を聞いてほしい"],
            ["topic_id" => 6, "name" => "意見を聞きたい"],
            ["topic_id" => 6, "name" => "報告したい"],
            ["topic_id" => 6, "name" => "その他"],

            ["topic_id" => 7, "name" => "具体的なアドバイスがほしい"],
            ["topic_id" => 7, "name" => "一緒に考えてほしい"],
            ["topic_id" => 7, "name" => "話を聞いてほしい"],
            ["topic_id" => 7, "name" => "意見を聞きたい"],
            ["topic_id" => 7, "name" => "報告したい"],
            ["topic_id" => 7, "name" => "その他"],

            ["topic_id" => 3, "name" => "具体的なアドバイスがほしい"],
            ["topic_id" => 3, "name" => "一緒に考えてほしい"],
            ["topic_id" => 3, "name" => "話を聞いてほしい"],
            ["topic_id" => 3, "name" => "意見を聞きたい"],
            ["topic_id" => 3, "name" => "報告したい"],
            ["topic_id" => 3, "name" => "その他"],
        ]);
    }
}
