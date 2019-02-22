<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
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
            $table->string('nm_user');
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('level',['staf_tu','pimpinan','administrator']);
            $table->string('foto');
            $table->integer('id_satuan_kerja')->length(10)->unsigned();
            $table->rememberToken();
            $table->timestamps();
        });
        
        Schema::table('tb_user',function($table){
            $table->foreign('id_satuan_kerja')
            ->references('id')
            ->on('tb_satuan_kerja')
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
