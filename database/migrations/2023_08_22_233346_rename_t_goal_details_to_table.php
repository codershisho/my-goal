<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('t_goal_details', 't_mtg_details');
        Schema::table('t_mtg_details', function (Blueprint $table) {
            $table->integer('term_id')->comment('期間ID')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('t_mtg_details', 't_goal_details');
    }
};
