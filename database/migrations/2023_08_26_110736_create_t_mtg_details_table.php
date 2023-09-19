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
        Schema::create('t_mtg_details', function (Blueprint $table) {
            $table->id()->comment('MTG詳細ID');
            $table->unsignedBigInteger('mtg_id')->comment('MTGID');
            $table->unsignedBigInteger('topic_id')->comment('トピックID');
            $table->tinyInteger('topic_checked')->default(0)->comment('トピックの選択状態');
            $table->unsignedBigInteger('topic_detail_id')->comment('トピック詳細ID');
            $table->text('from_memo')->nullable()->default(null)->comment('自分用メモ');
            $table->text('to_memo')->nullable()->default(null)->comment('面談者メモ');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('mtg_id')->references('id')->on('t_mtgs')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('m_topics')->onDelete('cascade');
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
        Schema::dropIfExists('t_mtg_details');
    }
};
