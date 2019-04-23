<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbDisposisiSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_disposisi_surat_masuk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_surat_masuk')->length(10)->unsigned();
            $table->integer('id_pengirim_disposisi')->length(10)->unsigned()->nullable();
            $table->integer('id_penerima_disposisi')->length(10)->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('tb_disposisi_surat_masuk',function($table){
            $table->foreign('id_surat_masuk')
            ->references('id')
            ->on('tb_surat_masuk')
            ->onUpdate('CASCADE');
        });

        Schema::table('tb_disposisi_surat_masuk',function($table){
            $table->foreign('id_pengirim_disposisi')
            ->references('id')
            ->on('tb_user')
            ->onUpdate('CASCADE');
        });

        Schema::table('tb_disposisi_surat_masuk',function($table){
            $table->foreign('id_penerima_disposisi')
            ->references('id')
            ->on('tb_user')
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
        Schema::dropIfExists('tb_disposisi_surat_masuk');
    }
}
