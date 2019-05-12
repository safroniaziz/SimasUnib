<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveStatusTeruskanColumnFromTbSuratKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_surat_keluar', function (Blueprint $table) {
            $table->dropColumn('status_teruskan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_surat_keluar', function (Blueprint $table) {
            $table->enum('status_teruskan',['1','0'])->default(0)->after('status');                                    
        });
    }
}
