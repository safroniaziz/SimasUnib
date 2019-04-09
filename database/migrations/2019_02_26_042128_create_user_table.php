<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jabatan')->length(10)->unsigned();;
            $table->string('nip')->length(18)->unique();
            $table->string('nm_user');
            $table->string('username');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('foto')->nullable();
            $table->string('telephone')->nullable();;
            $table->enum('level_user',['pimpinan','staf_tu']);
            $table->enum('status',['0','1'])->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->unique(['username','email','nip']);
        });

        Schema::table('tb_user',function($table){
            $table->foreign('id_jabatan')
            ->references('id')
            ->on('tb_jabatan')
            ->onUpdate('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_user');
    }
}
