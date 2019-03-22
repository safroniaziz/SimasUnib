<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveLevelDisposisiColumnFromTbPejabatDisposisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_pejabat_disposisi', function (Blueprint $table) {
            $table->dropColumn('level_disposisi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_pejabat_disposisi', function (Blueprint $table) {
            $table->string('level_disposisi')->after('email');
        });
    }
}
