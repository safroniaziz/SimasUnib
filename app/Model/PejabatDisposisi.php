<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PejabatDisposisi extends Model
{
    protected $table = 'tb_pejabat_disposisi';
    protected $fillable = ['id_satuan_kerja','nm_pejabat','nip_pejabat','id_jabatan','no_telephone','email','level_disposisi'];
    
}
