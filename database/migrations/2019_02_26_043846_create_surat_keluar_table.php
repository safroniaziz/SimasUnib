<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_surat_keluar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jenis_surat')->length(10)->unsigned();
            $table->string('no_surat')->length(30);
            $table->string('perihal');
            $table->string('tujuan');
            $table->string('lampiran');
            $table->string('catatan');
            $table->enum('sifat_surat',['penting','segera','rahasia','biasa']);
            $table->integer('status')->length(1);
            $table->timestamps();
        });

        Schema::table('tb_surat_keluar',function($table){
            $table->foreign('id_jenis_surat')
            ->references('id')
            ->on('tb_jenis_surat')
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
        Schema::dropIfExists('tb_surat_keluar');
    }
}
