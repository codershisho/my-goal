<?php

namespace Database\Seeders;

use App\Models\MTerm;
use App\Models\MTopic;
use App\Models\MTopicDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        // truncate
        User::truncate();
        MTerm::truncate();
        MTopic::truncate();
        MTopicDetail::truncate();
        Schema::enableForeignKeyConstraints();

        // create
        $this->call(UserSeeder::class);
        $this->call(MTermsTableSeeder::class);
        $this->call(MTopicsTableSeeder::class);
        $this->call(MTopicDetailsTableSeeder::class);
    }
}
