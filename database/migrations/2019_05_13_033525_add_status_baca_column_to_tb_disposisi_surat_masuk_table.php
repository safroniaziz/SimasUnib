<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusBacaColumnToTbDisposisiSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_disposisi_surat_masuk', function (Blueprint $table) {
            $table->enum('status_baca',['1','0'])->default(0)->after('status_teruskan');                                   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_disposisi_surat_masuk', function (Blueprint $table) {
            //
        });
    }
}
