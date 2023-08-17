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
        Schema::create('m_topic_details', function (Blueprint $table) {
            $table->id()->comment('トピック詳細ID');
            $table->unsignedBigInteger('topic_id')->comment('トピックID');
            $table->string('name')->comment('トピック詳細名');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('topic_id')->references('id')->on('m_topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_topic_details');
    }
};
