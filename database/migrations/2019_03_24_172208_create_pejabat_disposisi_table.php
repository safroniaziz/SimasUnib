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
            $table->integer('id_pejabat')->length(10)->unsigned();
            $table->integer('id_disposisi_pejabat')->length(10)->unsigned();
            $table->timestamps();
        });

        Schema::table('tb_pejabat_disposisi',function($table){
            $table->foreign('id_pejabat')
            ->references('id')
            ->on('tb_user')
            ->onUpdate('CASCADE');
        });

        Schema::table('tb_pejabat_disposisi',function($table){
            $table->foreign('id_disposisi_pejabat')
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
        Schema::dropIfExists('tb_pejabat_disposisi');
    }
}
