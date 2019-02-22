<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use DataTables;
use App\Model\KodeSurat;

class KodeSuratController extends Controller
{
    public function index(){
        if(!Gate::allows('isAdmin')){
            return redirect()->back()->with('gagal-admin', 'Anda tidak memiliki akses admin, silahkan logout dan login kembali sebagai admin'); 
        }
        return view('admin/kode_surat.index');
    }

    public function create(){
        $model = new KodeSurat();
        return view('admin/kode_surat.form',compact('model'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'kode_surat'    =>  'required|string|max:10|unique:tb_kode_surat,kode_surat',
            'keterangan'    =>  'required|string|'
        ]);

        $model = KodeSurat::create($request->all());
        return $model;
    }

    public function show()
    {

    }

    public function edit($id){
        $model = KodeSurat::findOrFail($id);
        return view('admin/kode_surat.form',compact('model'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'kode_surat'    =>  'required|string|max:10|unique:tb_kode_surat,kode_surat,' . $id,
            'keterangan'    =>  'required|string|'
        ]);

        $model = KodeSurat::findOrFail($id);
        $model->update($request->all());
        
    }

    public function destroy($id)
    {
        $model = KodeSurat::findOrFail($id);
        $model->delete();
    }

    public function dataTable(){
        $model = KodeSurat::query();
        return DataTables::of($model)
                ->addColumn('action', function($model){
                    return view('layouts/partials._action',[
                        'model' =>  $model,
                        'url_show'  => route('admin.kode_surat.show', $model->id),
                        'url_edit'  => route('admin.kode_surat.edit', $model->id),
                        'url_destroy'  => route('admin.kode_surat.destroy', $model->id),
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
}
