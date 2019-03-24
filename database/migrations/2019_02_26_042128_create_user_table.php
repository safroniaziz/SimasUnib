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
            $table->integer('id_satuan_kerja')->length(10)->unsigned();
            $table->integer('nm_lengkap')->length(10)->unsigned();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('foto');
            $table->integer('id_jabatan')->length(10)->unsigned();;
            $table->string('telephone');
            $table->enum('level',['pimpinan','staf_tu']);
            $table->rememberToken();
            $table->timestamps();
        });
        
        Schema::table('tb_user',function($table){
            $table->foreign('id_satuan_kerja')
            ->references('id')
            ->on('tb_satuan_kerja')
            ->onUpdate('CASCADE');
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
