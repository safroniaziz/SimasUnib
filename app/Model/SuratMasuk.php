<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'tb_surat_masuk';
    protected $fillable = ['tipe_surat','id_satker_pengirim_surat','id_satker_penerima_surat','id_pimpinan_penerima_surat','pengirim_surat','id_jenis_surat','no_surat','perihal','tujuan','lampiran','catatan','sifat_surat','tanggal_surat','status'];
}
