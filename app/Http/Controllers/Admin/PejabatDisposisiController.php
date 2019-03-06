<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Model\PejabatDisposisi;
use DataTables;
use DB;

class PejabatDisposisiController extends Controller
{
    public function index(){
        if(!Gate::allows('isAdmin')){
            return redirect()->back()->with('gagal-admin', 'Anda tidak memiliki akses admin, silahkan logout dan login kembali sebagai admin'); 
        }
        return view('admin/pejabat_disposisi.index',compact('id_satuan_kerja'));
    }

    public function create(){
        $model = new PejabatDisposisi();
        $id_satuan_kerja = DB::table('tb_satuan_kerja')->select('id','nm_satuan_kerja')->get();        
        $id_jabatan = DB::table('tb_jabatan')->select('id','nm_jabatan')->get();        
        return view('admin/pejabat_disposisi.form',compact('model','id_satuan_kerja','id_jabatan'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'id_satuan_kerja'    =>  'required|numeric|',
            'nm_pejabat'    =>  'required|string|',
            'nip_pejabat'    =>  'required|numeric|unique:tb_pejabat_disposisi,nip_pejabat',
            'id_jabatan'    =>  'required|numeric|',
            'email'    =>  'email|string|unique:tb_pejabat_disposisi,email',
            'level_disposisi'    =>  'required|numeric|max:40|min:1|unique:tb_pejabat_disposisi,level_disposisi',
        ]);

        $model = PejabatDisposisi::create($request->all());
        return $model;
    }

    public function edit($id){
        $model = PejabatDisposisi::findOrFail($id);
        $id_satuan_kerja = DB::table('tb_satuan_kerja')->select('id','nm_satuan_kerja')->get();        
        $id_jabatan = DB::table('tb_jabatan')->select('id','nm_jabatan')->get();        
        return view('admin/pejabat_disposisi.form',compact('model','id_satuan_kerja','id_jabatan'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'id_satuan_kerja'    =>  'required|numeric|',
            'nm_pejabat'    =>  'required|string|',
            'nip_pejabat'    =>  'required|numeric|unique:tb_pejabat_disposisi,nip_pejabat,' . $id,
            'id_jabatan'    =>  'required|numeric|',
            'email'    =>  'email|string|unique:tb_pejabat_disposisi,email,' . $id,
            'level_disposisi'    =>  'required|numeric|max:40|min:1|unique:tb_pejabat_disposisi,level_disposisi,' . $id,
        ]);

        $model = PejabatDisposisi::findOrFail($id);
        $model->update($request->all());
        
    }

    public function destroy($id)
    {
        $model = PejabatDisposisi::findOrFail($id);
        $model->delete();
    }

    public function dataTable(){
        $model = DB::table('tb_pejabat_disposisi')
                ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_pejabat_disposisi.id_satuan_kerja')
                ->join('tb_jabatan','tb_jabatan.id','tb_pejabat_disposisi.id_jabatan')
                ->select('tb_pejabat_disposisi.id','nm_satuan_kerja','nm_pejabat','nip_pejabat','nm_jabatan','no_telephone','email','level_disposisi')
                ->get();
        return DataTables::of($model)
                ->addColumn('action', function($model){
                    return view('layouts/partials._action',[
                        'model' =>  $model,
                        'url_show'  => route('admin.pejabat_disposisi.show', $model->id),
                        'url_edit'  => route('admin.pejabat_disposisi.edit', $model->id),
                        'url_destroy'  => route('admin.pejabat_disposisi.destroy', $model->id),
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
}
