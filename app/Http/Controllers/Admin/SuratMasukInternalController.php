<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Model\SuratMasuk;
use DataTables;
use DB;

class SuratMasukInternalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(){
        return view('admin/surat_masuk.internal');
    }

    // public function create(){
    //     $model = new SuratMasuk();
        
    //     $id_pejabat_disposisi = DB::table('tb_pejabat_disposisi')->select('id','nm_pejabat')->get();
    //     $id_jenis_surat = DB::table('tb_jenis_surat')->select('id','jenis_surat')->get();
    //     return view('admin/surat_masuk.form',compact('model','id_pejabat_disposisi','id_jenis_surat'));
    // }

    // public function store(Request $request){
    //     $this->validate($request,[
    //         'nm_satuan_kerja'    =>  'required|string|',
    //         'nm_satuan_kerja_singkat'    =>  'required|string|',
    //     ]);

    //     $model = SuratMasuk::create($request->all());
    //     return $model;
    // }

    // public function edit($id){
    //     $model = SuratMasuk::findOrFail($id);
    //     return view('admin/surat_masuk.form',compact('model'));
    // }

    // public function update(Request $request, $id){
    //     $this->validate($request,[
    //         'nm_satuan_kerja'    =>  'required|string|',
    //         'nm_satuan_kerja_singkat'    =>  'required|string|',
    //     ]);

    //     $model = SuratMasuk::findOrFail($id);
    //     $model->update($request->all());
        
    // }

    // public function destroy($id)
    // {
    //     $model = SuratMasuk::findOrFail($id);
    //     $model->delete();
    // }

    public function dataTable(){
        $model = DB::table('tb_surat_masuk')
                ->join('tb_satuan_kerja as pengirim_surat','pengirim_surat.id','tb_surat_masuk.id_satker_pengirim_surat')
                ->join('tb_satuan_kerja as penerima_surat','penerima_surat.id','tb_surat_masuk.id_satker_penerima_surat')
                ->join('tb_jenis_surat','tb_jenis_surat.id','tb_surat_masuk.id_jenis_surat')
                ->where('tb_surat_masuk.tipe_surat','internal')
                ->select('tb_surat_masuk.id','tipe_surat','pengirim_surat.nm_satuan_kerja_singkat as nm_pengirim_surat','penerima_surat.nm_satuan_kerja_singkat as nm_penerima_surat',
                        'tb_jenis_surat.jenis_surat','no_surat','perihal','tujuan','lampiran','catatan','sifat_surat',
                        'tanggal_surat','tb_surat_masuk.status',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
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
