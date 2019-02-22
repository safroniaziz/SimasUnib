<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KodeSurat extends Model
{
    protected $table ='tb_kode_surat';
    protected $fillable = ['kode_surat','keterangan'];
}
