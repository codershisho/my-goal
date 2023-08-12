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
        Schema::create('t_goal_details', function (Blueprint $table) {
            $table->id()->comment('ゴール詳細ID');
            $table->date('mtg_date')->nullable()->comment('MTG日付');
            $table->tinyInteger('status')->default(0)->comment('ステータス');
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->unsignedBigInteger('partner_user_id')->comment('面談者ユーザーID');
            $table->unsignedBigInteger('topic_detail_id')->comment('トピック詳細ID');
            $table->text('memo_own')->nullable()->default(null)->comment('自分用メモ');
            $table->text('memo_partner')->nullable()->default(null)->comment('面談者メモ');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('partner_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('topic_detail_id')->references('id')->on('m_topic_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_goal_details');
    }
};
