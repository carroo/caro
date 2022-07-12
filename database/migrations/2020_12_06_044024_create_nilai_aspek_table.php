<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiAspekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_aspek', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('guru');
            $table->foreign('guru')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('tanggung_jawab');
            $table->tinyInteger('kedisiplinan');
            $table->tinyInteger('sosialisasi');
            $table->tinyInteger('perilaku');
            $table->tinyInteger('keaktifan');
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
        Schema::dropIfExists('nilai_aspek');
    }
}
