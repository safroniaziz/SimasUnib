<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_jenis_surat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kode_surat')->length(10)->unsigned();
            $table->string('jenis_surat');
            $table->string('keterangan');
            $table->timestamps();
        });

        Schema::table('tb_jenis_surat',function($table){
            $table->foreign('id_kode_surat')
            ->references('id')
            ->on('tb_kode_surat')
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
        Schema::dropIfExists('tb_jenis_surat');
    }
}
