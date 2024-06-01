<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fullname')->nullable();
            $table->string('email')->unique();
            $table->string('password')->default( Hash::make('password'));
            $table->tinyInteger('level')->default(0);
            $table->tinyInteger('kelas')->default(0);
            $table->tinyInteger('jurusan')->default(0);
            $table->string('nisn')->default(0);
            $table->string('alamat')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('phone')->nullable();
            $table->tinyInteger('agama')->nullable();
            $table->tinyInteger('kelamin')->default(0);
            $table->tinyInteger('mapel')->default(0);
            $table->string('nip')->default(0);
            $table->string('photo')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
