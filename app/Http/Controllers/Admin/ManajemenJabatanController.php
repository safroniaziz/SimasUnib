<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Model\Jabatan;
use DataTables;
use DB;

class ManajemenJabatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin/manajemen_jabatan.index');
    }

    public function create(){
        $model = new Jabatan();
        $id_satuan_kerja = DB::table('tb_satuan_kerja')->select('id','nm_satuan_kerja')->get();
        return view('admin/manajemen_jabatan.form',compact('model','id_satuan_kerja'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'id_satuan_kerja'    =>  'required|',
            'nm_jabatan'    =>  'required|string|',
        ]);

        $model = Jabatan::create($request->all());
        return $model;
    }

    public function edit($id){
        $model = Jabatan::findOrFail($id);
        return view('admin/manajemen_jabatan.form',compact('model'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'id_satuan_kerja'    =>  'required|',
            'nm_jabatan'    =>  'required|string|',
        ]);

        $model = Jabatan::findOrFail($id);
        $model->update($request->all());
        
    }

    public function destroy($id)
    {
        $model = Jabatan::findOrFail($id);
        $model->delete();
    }

    public function dataTable(){
        $model = DB::table('tb_jabatan')
                ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_jabatan.id_satuan_kerja')
                ->select('tb_jabatan.id','nm_satuan_kerja','nm_jabatan','keterangan')
                ->get();
        return DataTables::of($model)
                ->addColumn('action', function($model){
                    return view('layouts/partials._action',[
                        'model' =>  $model,
                        'url_show'  => route('admin.manajemen_jabatan.show', $model->id),
                        'url_edit'  => route('admin.manajemen_jabatan.edit', $model->id),
                        'url_destroy'  => route('admin.manajemen_jabatan.destroy', $model->id),
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
}
