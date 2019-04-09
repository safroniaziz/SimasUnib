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
            $table->integer('id_satuan_kerja_pengirim')->length(10)->unsigned();
            $table->integer('id_satuan_kerja_penerima')->length(10)->unsigned();
            $table->integer('id_jenis_surat')->length(10)->unsigned();
            $table->string('no_surat')->length(30);
            $table->string('perihal')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('lampiran')->nullable();
            $table->string('catatan')->nullable();
            $table->enum('sifat_surat',['penting','segera','biasa','rahasia']);
            $table->enum('status',['0','1'])->default(0);
            $table->timestamps();
        });

        Schema::table('tb_surat_keluar',function($table){
            $table->foreign('id_satuan_kerja_pengirim')
            ->references('id')
            ->on('tb_satuan_kerja')
            ->onUpdate('CASCADE');
        });
        
        Schema::table('tb_surat_keluar',function($table){
            $table->foreign('id_satuan_kerja_penerima')
            ->references('id')
            ->on('tb_satuan_kerja')
            ->onUpdate('CASCADE');
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
