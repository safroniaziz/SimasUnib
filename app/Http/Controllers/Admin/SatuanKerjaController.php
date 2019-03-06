<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Model\SatuanKerja;
use DataTables;

class SatuanKerjaController extends Controller
{
    public function index(){
        if(!Gate::allows('isAdmin')){
            return redirect()->back()->with('gagal-admin', 'Anda tidak memiliki akses admin, silahkan logout dan login kembali sebagai admin'); 
        }
        return view('admin/satuan_kerja.index');
    }

    public function create(){
        $model = new SatuanKerja();
        return view('admin/satuan_kerja.form',compact('model'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'nm_satuan_kerja'    =>  'required|string|',
            'nm_satuan_kerja_singkat'    =>  'required|string|',
        ]);

        $model = SatuanKerja::create($request->all());
        return $model;
    }

    public function edit($id){
        $model = SatuanKerja::findOrFail($id);
        return view('admin/satuan_kerja.form',compact('model'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'nm_satuan_kerja'    =>  'required|string|',
            'nm_satuan_kerja_singkat'    =>  'required|string|',
        ]);

        $model = SatuanKerja::findOrFail($id);
        $model->update($request->all());
        
    }

    public function destroy($id)
    {
        $model = SatuanKerja::findOrFail($id);
        $model->delete();
    }

    public function dataTable(){
        $model = SatuanKerja::query();
        return DataTables::of($model)
                ->addColumn('action', function($model){
                    return view('layouts/partials._action',[
                        'model' =>  $model,
                        'url_show'  => route('admin.satuan_kerja.show', $model->id),
                        'url_edit'  => route('admin.satuan_kerja.edit', $model->id),
                        'url_destroy'  => route('admin.satuan_kerja.destroy', $model->id),
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
}
