<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusTeruskanTanggalSuratAndPenerimaSuratColumnToTbSuratKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_surat_keluar', function (Blueprint $table) {
            $table->enum('tipe_surat',['internal','eksternal'])->after('id');                        
            $table->enum('status_teruskan',['1','0'])->default(0)->after('status');                        
            $table->date('tanggal_surat')->after('sifat_surat');
            $table->string('penerima_surat')->after('id_satuan_kerja_penerima');
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
            $table->dropColumn('status_teruskan');
            $table->dropColumn('tanggal_surat');
            $table->dropColumn('penerima_surat');            
        });
    }
}
