<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PejabatDisposisi extends Model
{
    protected $table = 'tb_pejabat_disposisi';
    protected $fillable = ['id_satuan_kerja','id_pejabat','id_disposisi_pejabat'];
    
}
