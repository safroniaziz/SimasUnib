<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropIdKodeSuratForeignAndColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_jenis_surat', function (Blueprint $table) {
            $table->dropForeign(['id_kode_surat']);
            $table->dropColumn('id_kode_surat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_jenis_surat', function (Blueprint $table) {
            //
        });
    }
}
