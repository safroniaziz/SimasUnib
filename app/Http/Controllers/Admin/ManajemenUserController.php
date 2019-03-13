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

    public function store(Request $request){
        $this->validate($request,[
            'id_satuan_kerja'    =>  'required|',
            'nm_user'    =>  'required|string|',
            'username'    =>  'required|string|',
            'password'    =>  'required|string|',
            'level'      =>     'required',
        ]);

        $model = $request->all();
        User::create($model);
        return view('admin/manajemen_user.index');
        
    }

    public function edit($id)
    {
        $model = User::findOrFail($id);
        return $model;
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'id_satuan_kerja'    =>  'required|',
            'nm_user'    =>  'required|string|',
            'username'    =>  'required|string|',
            'password'    =>  'required|string|',
            'level'      =>     'required',
        ]);

        $model = User::findOrFail($id);
        $model->update($request->all());
        return $model;
        
    }

    public function destroy($id)
    {
        $model = User::findOrFail($id);
        $model->delete();
    }

    public function dataTable(){
        DB::statement(DB::raw('set @rownum=0'));
        $model = DB::table('tb_user')
                ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_user.id_satuan_kerja')
                ->where('tb_satuan_kerja.nm_satuan_kerja','!=','administrator')
                ->select('tb_user.id','tb_satuan_kerja.id as id_satuan_kerja','tb_satuan_kerja.nm_satuan_kerja','nm_user','username','foto','level','tb_user.created_at',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                ->get();
        return DataTables::of($model)
                ->addColumn('action', function($model){
                    return
                        '<a onclick="formEditUser('. $model->id .')" class="btn btn-primary social-button btn-xs" style="padding:5px; color:white;><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                        '<a onclick="formHapusUser('. $model->id .')" class="btn btn-danger social-button btn-xs" style="padding:5px;color:white"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                })->make(true);
    }
}
