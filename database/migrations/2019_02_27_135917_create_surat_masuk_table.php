<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratMasukTable extends Migration
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
            $table->integer('id_pejabat_disposisi')->length(10)->unsigned();
            $table->integer('id_jenis_surat')->length(10)->unsigned();
            $table->string('no_surat')->length(30)->unique();
            $table->string('pengirim')->length(50);
            $table->string('perihal');
            $table->string('tujuan');
            $table->string('lampiran');
            $table->string('catatan');
            $table->enum('sifat_surat',['penting','segera','rahasia','biasa']);
            $table->enum('status',['1','0'])->default(0);
            $table->timestamps();
        });

        Schema::table('tb_surat_masuk',function($table){
            $table->foreign('id_pejabat_disposisi')
            ->references('id')
            ->on('tb_pejabat_disposisi')
            ->onUpdate('CASCADE');
        });

        Schema::table('tb_surat_masuk',function($table){
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
        Schema::dropIfExists('tb_surat_masuk');
    }
}
