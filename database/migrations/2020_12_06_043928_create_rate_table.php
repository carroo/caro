<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penilai');
            $table->foreign('penilai')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('dinilai');
            $table->foreign('dinilai')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('nilai');
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
        Schema::dropIfExists('rate');
    }
}
