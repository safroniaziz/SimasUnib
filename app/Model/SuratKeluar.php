<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'tb_surat_keluar';
    protected $fillable = ['tipe_surat','id_satuan_kerja_pengirim','id_satuan_kerja_penerima','penerima_surat',
                            'id_jenis_surat','no_surat','perihal','tujuan','lampiran','catatan','catatan','sifat_surat',
                            'tanggal_surat','status','status_teruskan'];
    protected $primaryKey="id";
}
