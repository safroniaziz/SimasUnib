<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'tb_jabatan';
    protected $fillable = ['nm_jabatan','keterangan','id_satuan_kerja'];
}
