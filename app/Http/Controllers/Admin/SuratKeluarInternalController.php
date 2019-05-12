<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\SuratKeluar;
use DataTables;

class SuratKeluarInternalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(){
        return view('admin/surat_keluar.internal');
    }

    public function dataTable(){
        $model = DB::table('tb_surat_keluar')
                ->join('tb_satuan_kerja as pengirim_surat','pengirim_surat.id','tb_surat_keluar.id_satuan_kerja_pengirim')
                ->join('tb_satuan_kerja as penerima_surat','penerima_surat.id','tb_surat_keluar.id_satuan_kerja_penerima')
                ->join('tb_jenis_surat','tb_jenis_surat.id','tb_surat_keluar.id_jenis_surat')
                ->where('tb_surat_keluar.tipe_surat','internal')
                ->select('tb_surat_keluar.id','tipe_surat','pengirim_surat.nm_satuan_kerja_singkat as nm_pengirim_surat','penerima_surat.nm_satuan_kerja_singkat as nm_penerima_surat',
                        'tb_jenis_surat.jenis_surat','no_surat','perihal','tujuan','lampiran','catatan','sifat_surat',
                        'tanggal_surat','tb_surat_keluar.status',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                ->get();
        return DataTables::of($model)
                ->addColumn('lampiran',function($model){
                    if($model->lampiran == NULL){
                        return '<label class="badge badge-danger"><i class="fa fa-close"></i> Tidak Ada Foto</label>';
                    }
                    else
                    {
                        return '<img class="" width="50" height="50" src="'. url($model->lampiran) .'" alt="">';
                    }
                })
                ->addIndexColumn()
                ->rawColumns(['action','lampiran'])
                ->make(true);
    }
}
