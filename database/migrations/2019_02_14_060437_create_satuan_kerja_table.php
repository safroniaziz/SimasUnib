<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSatuanKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_satuan_kerja', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nm_satuan_kerja');
            $table->string('nm_satuan_kerja_singkat');
            $table->string('nm_pimpinan');
            $table->string('nip_pimpinan');
            $table->enum('jabatan',['rektor','dekan','ketua']);
            $table->string('no_hp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_satuan_kerja');
    }
}
