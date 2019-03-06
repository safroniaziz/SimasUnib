<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePejabatDisposisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pejabat_disposisi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_satuan_kerja')->length(10)->unsigned();
            $table->string('nm_pejabat');
            $table->string('nip_pejabat')->length(18)->nullable();
            $table->integer('id_jabatan')->length(10)->unsigned();
            $table->string('no_telephone')->length(15)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('foto')->nullable();
            $table->integer('level_disposisi')->length(3);
            $table->timestamps();
        });

        Schema::table('tb_pejabat_disposisi',function($table){
            $table->foreign('id_satuan_kerja')
            ->references('id')
            ->on('tb_satuan_kerja')
            ->onUpdate('CASCADE');
        });

        Schema::table('tb_pejabat_disposisi',function($table){
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
        Schema::dropIfExists('tb_pejabat_disposisi');
    }
}
