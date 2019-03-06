<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Model\SuratMasuk;
use DataTables;
use DB;

class SuratMasukController extends Controller
{
    public function index(){
        if(!Gate::allows('isAdmin')){
            return redirect()->back()->with('gagal-admin', 'Anda tidak memiliki akses admin, silahkan logout dan login kembali sebagai admin'); 
        }
        return view('admin/surat_masuk.index');
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
                ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_surat_masuk.id_pengirim')
                ->join('tb_pejabat_disposisi','tb_pejabat_disposisi.id','tb_surat_masuk.id_pejabat_disposisi')
                ->join('tb_jabatan','tb_jabatan.id','tb_pejabat_disposisi.id_jabatan')
                ->join('tb_jenis_surat','tb_jenis_surat.id','tb_surat_masuk.id_jenis_surat')
                ->select('tb_surat_masuk.id','nm_pejabat','tb_pejabat_disposisi.nip_pejabat','nm_jabatan','jenis_surat','no_surat','nm_satuan_kerja as pengirim','perihal','tujuan','lampiran','catatan','sifat_surat','status')
                ->get();
        return DataTables::of($model)
                ->addColumn('action', function($model){
                    return view('layouts/partials._action',[
                        'model' =>  $model,
                        'url_show'  => route('admin.surat_masuk.show', $model->id),
                        'url_edit'  => route('admin.surat_masuk.edit', $model->id),
                        'url_destroy'  => route('admin.surat_masuk.destroy', $model->id),
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
}
