<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'tb_surat_masuk';
    protected $fillable = ['id_pejabat_disposisi','id_jenis_surat','tanggal_surat','no_surat','pengirim','perihal','tujuan','lampiran','catatan','sifat_surat','status'];
}
