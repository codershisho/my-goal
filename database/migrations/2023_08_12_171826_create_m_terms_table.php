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
        Schema::create('m_terms', function (Blueprint $table) {
            $table->id()->comment('期間ID');
            $table->string('name')->comment('期間名');
            $table->date('from')->nullable()->comment('期の開始日');
            $table->date('to')->nullable()->comment('期の終了日');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_terms');
    }
};
