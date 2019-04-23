<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_surat_masuk', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipe_surat',['internal','eksternal']);
            $table->integer('id_satker_pengirim_surat')->length(10)->unsigned()->nullable();
            $table->integer('id_satker_penerima_surat')->length(10)->unsigned()->nullable();
            $table->string('pengirim_surat');
            $table->integer('id_jenis_surat')->length(10)->unsigned();
            $table->string('no_surat')->length(30)->unique();
            $table->string('perihal')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('lampiran')->nullable();
            $table->string('catatan')->nullable();
            $table->enum('sifat_surat',['penting','segera','rahasia','biasa']);
            $table->date('tanggal_surat');
            $table->enum('status',['1','0'])->default(0);
            $table->timestamps();
        });

        Schema::table('tb_surat_masuk',function($table){
            $table->foreign('id_jenis_surat')
            ->references('id')
            ->on('tb_jenis_surat')
            ->onUpdate('CASCADE');
        });

        Schema::table('tb_surat_masuk',function($table){
            $table->foreign('id_satker_pengirim_surat')
            ->references('id')
            ->on('tb_satuan_kerja')
            ->onUpdate('CASCADE');
        });

        Schema::table('tb_surat_masuk',function($table){
            $table->foreign('id_satker_penerima_surat')
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
        Schema::dropIfExists('tb_surat_masuk');
    }
}
