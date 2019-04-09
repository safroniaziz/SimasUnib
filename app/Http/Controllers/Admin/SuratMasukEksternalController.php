<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Model\SuratMasuk;
use DataTables;
use DB;

class SuratMasukEksternalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(){
        return view('admin/surat_masuk.eksternal');
    }

    public function create(){
        $model = new SuratMasuk();
        
        $id_pejabat_disposisi = DB::table('tb_pejabat_disposisi')->select('id','nm_pejabat')->get();
        $id_jenis_surat = DB::table('tb_jenis_surat')->select('id','jenis_surat')->get();
        return view('admin/surat_masuk.form',compact('model','id_pejabat_disposisi','id_jenis_surat'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'nm_satuan_kerja'    =>  'required|string|',
            'nm_satuan_kerja_singkat'    =>  'required|string|',
        ]);

        $model = SuratMasuk::create($request->all());
        return $model;
    }

    public function edit($id){
        $model = SuratMasuk::findOrFail($id);
        return view('admin/surat_masuk.form',compact('model'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'nm_satuan_kerja'    =>  'required|string|',
            'nm_satuan_kerja_singkat'    =>  'required|string|',
        ]);

        $model = SuratMasuk::findOrFail($id);
        $model->update($request->all());
        
    }

    public function destroy($id)
    {
        $model = SuratMasuk::findOrFail($id);
        $model->delete();
    }

    public function dataTable(){
        $model = DB::table('tb_surat_masuk')
                ->join('tb_user as id_pengirim_surat','id_pengirim_surat.id','tb_surat_masuk.id_pengirim_surat')
                ->join('tb_jenis_surat','tb_jenis_surat.id','tb_surat_masuk.id_jenis_surat')
                ->where('tb_surat_masuk.tipe_surat','eksternal')
                ->select('tb_surat_masuk.id','tipe_surat','id_pengirim_surat.nm_user as nm_pengirim_surat','tb_jenis_surat.jenis_surat','no_surat','perihal','tujuan','lampiran','catatan','sifat_surat','tanggal_surat','tb_surat_masuk.status',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                ->get();
        return DataTables::of($model)
              
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
}
