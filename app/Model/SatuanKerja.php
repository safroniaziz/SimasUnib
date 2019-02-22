<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SatuanKerja extends Model
{
    protected $table = 'tb_satuan_kerja';
    protected $fillable = ['nm_satuan_kerja','nm_satuan_kerja_singkat','nm_pimpinan','nip_pimpinan','jabatan','no_hp'];
}
