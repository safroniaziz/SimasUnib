<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Model\User;
use DataTables;
use DB;

class ManajemenUserController extends Controller
{
    public function index(){
        if(!Gate::allows('isAdmin')){
            return redirect()->back()->with('gagal-admin', 'Anda tidak memiliki akses admin, silahkan logout dan login kembali sebagai admin'); 
        }
        return view('admin/manajemen_user.index');
    }

    public function create(){
        $model = new User();
        $id_satuan_kerja = DB::table('tb_satuan_kerja')->select('id','nm_satuan_kerja')->where('nm_satuan_kerja','!=','administrator')->get();
        return view('admin/manajemen_user.form',compact('model','id_satuan_kerja'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'id_satuan_kerja'    =>  'required|',
            'nm_user'    =>  'required|string|',
            'username'    =>  'required|string|',
            'password'    =>  'required|string|',
            'level'      =>     'required',
        ]);

        $model = $request->all();
        $model['foto'] = null;
        if($request->hasFile('foto')){
            $model['foto'] = '/upload/foto/'.str_slug($input['nm_user'],'-').'.'.$request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('/upload/foto'),$input['foto']);
        }
        User::create($model);
        return response()->json([
            'success'   =>  true
        ]);
    }

    public function edit($id){
        $model = User::findOrFail($id);
        return view('admin/manajemen_user.form',compact('model'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'nm_jabatan'    =>  'required|string|',
            'keterangan'    =>  'required|string|',
        ]);

        $model = User::findOrFail($id);
        $model->update($request->all());
        
    }

    public function destroy($id)
    {
        $model = User::findOrFail($id);
        $model->delete();
    }

    public function dataTable(){
        $model = DB::table('tb_user')
                ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_user.id_satuan_kerja')
                ->where('tb_satuan_kerja.nm_satuan_kerja','!=','administrator')
                ->select('tb_user.id','tb_satuan_kerja.nm_satuan_kerja','nm_user','username','foto','level','tb_user.created_at')
                ->get();
        return DataTables::of($model)
                ->addColumn('action', function($model){
                    return view('layouts/partials._action',[
                        'model' =>  $model,
                        'url_show'  => route('admin.manajemen_user.show', $model->id),
                        'url_edit'  => route('admin.manajemen_user.edit', $model->id),
                        'url_destroy'  => route('admin.manajemen_user.destroy', $model->id),
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
}
