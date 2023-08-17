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
        Schema::create('t_goals', function (Blueprint $table) {
            $table->id()->comment('ゴールID');
            $table->unsignedBigInteger('term_id')->comment('期間ID');
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->text('goal_department')->nullable()->default(null)->comment('部目標');
            $table->text('goal_first')->nullable()->default(null)->comment('目標1');
            $table->text('goal_secound')->nullable()->default(null)->comment('目標2');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('term_id')->references('id')->on('m_topics')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_goals');
    }
};
