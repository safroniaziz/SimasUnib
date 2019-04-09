<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_jabatan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_satuan_kerja')->length(10)->unsigned();
            $table->string('nm_jabatan');
            $table->string('keterangan')->nullable();;
            $table->timestamps();
        });

        Schema::table('tb_jabatan',function($table){
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
        Schema::dropIfExists('tb_jabatan');
    }
}
