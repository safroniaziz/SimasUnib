<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $table = 'tb_jenis_surat';
    protected $fillable = ['id_kode_surat','jenis_surat','keterangan'];
}
