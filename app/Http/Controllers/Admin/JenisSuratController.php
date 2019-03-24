<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use DataTables;
use App\Model\JenisSurat;
use DB;

class JenisSuratController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){  
        return view('admin/jenis_surat.index');
    }

    public function create(){
        $model = new JenisSurat();
        return view('admin/jenis_surat.form',compact('model'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'jenis_surat'    =>  'required|string|',
            'keterangan'    =>  'required|string|'
        ]);

        $model = JenisSurat::create($request->all());
        return $model;
    }

    public function show()
    {

    }

    public function edit($id){
        $model = JenisSurat::findOrFail($id);
        return view('admin/jenis_surat.form',compact('model'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'jenis_surat'    =>  'required|string|',
            'keterangan'    =>  'required|string|'
        ]);

        $model = JenisSurat::findOrFail($id);
        $model->update($request->all());
        
    }

    public function destroy($id)
    {
        $model = JenisSurat::findOrFail($id);
        $model->delete();
    }

    public function dataTable(){
        $model = DB::table('tb_jenis_surat')
                ->select('tb_jenis_surat.id','jenis_surat','keterangan')
                ->get();
        return DataTables::of($model)
                ->addColumn('action', function($model){
                    return view('layouts/partials._action',[
                        'model' =>  $model,
                        'url_show'  => route('admin.jenis_surat.show', $model->id),
                        'url_edit'  => route('admin.jenis_surat.edit', $model->id),
                        'url_destroy'  => route('admin.jenis_surat.destroy', $model->id),
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
}
