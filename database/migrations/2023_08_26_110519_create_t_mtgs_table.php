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
        Schema::create('t_mtgs', function (Blueprint $table) {
            $table->id()->comment('MTGID');
            $table->date('mtg_date')->nullable()->comment('MTG日付');
            $table->tinyInteger('status')->default(0)->comment('ステータス');
            $table->unsignedBigInteger('from_user_id')->comment('ユーザーID');
            $table->unsignedBigInteger('to_user_id')->comment('面談者ユーザーID');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('from_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('to_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_mtgs');
    }
};
