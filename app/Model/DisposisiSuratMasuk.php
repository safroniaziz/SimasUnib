<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DisposisiSuratMasuk extends Model
{
    protected $table = 'tb_disposisi_surat_masuk';
    protected $fillable = ['id_surat_masuk','id_pengirim_disposisi','id_penerima_disposisi','status_teruskan'];
    protected $primaryKey="id";
}
