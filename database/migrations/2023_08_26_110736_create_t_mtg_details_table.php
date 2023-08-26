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
            $table->unsignedBigInteger('topic_detail_id')->comment('トピック詳細ID');
            $table->text('from_memo')->nullable()->default(null)->comment('自分用メモ');
            $table->text('to_memo')->nullable()->default(null)->comment('面談者メモ');
            $table->timestamps();
            $table->softDeletes();

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
