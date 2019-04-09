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
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(){
        return view('admin/pejabat_disposisi.index');
    }

    public function create(){
        $model = new PejabatDisposisi();
        $id_pejabat = DB::table('tb_user')->select('id','nm_user')->get();
        $id_disposisi_pejabat = DB::table('tb_user')->select('id','nm_user')->get();
        return view('admin/pejabat_disposisi.form',compact('model','id_satuan_kerja','id_pejabat','id_disposisi_pejabat'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'id_pejabat'    =>  'required|',
            'id_disposisi_pejabat'    =>  'required|',
        ]);

        $model = PejabatDisposisi::create($request->all());
        return $model;
    }

    public function edit($id){
        $model = PejabatDisposisi::findOrFail($id);
        $id_satuan_kerja = DB::table('tb_satuan_kerja')->select('id','nm_satuan_kerja')->get();
        $id_pejabat = DB::table('tb_user')->select('id','nm_user')->get();
        $id_disposisi_pejabat = DB::table('tb_user')->select('id','nm_user')->get();
        return view('admin/pejabat_disposisi.form',compact('model','id_satuan_kerja','id_pejabat','id_disposisi_pejabat'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'id_pejabat'    =>  'required|',
            'id_disposisi_pejabat'    =>  'required|',
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
                ->join('tb_user as tb_pejabat','tb_pejabat.id','tb_pejabat_disposisi.id_pejabat')
                ->join('tb_jabatan','tb_jabatan.id','tb_pejabat.id_jabatan')
                ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_jabatan.id_satuan_kerja')
                ->join('tb_user as tb_pejabat_dis','tb_pejabat_dis.id','tb_pejabat_disposisi.id_disposisi_pejabat')
                ->select('tb_pejabat_disposisi.id','tb_pejabat.nm_user as nm_pejabat','tb_satuan_kerja.nm_satuan_kerja','tb_jabatan.nm_jabatan','tb_pejabat.email','tb_pejabat.telephone','tb_pejabat_dis.nm_user as nm_pejabat_disposisi')
                ->orderBy('tb_pejabat.id','tb_pejabat_dis.id')
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
