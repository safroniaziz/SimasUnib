<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Model\User;
use DataTables;
use DB;
use Auth;

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
            'foto'        =>    'image|max:500',
            'level'      =>     'required',
        ]);
            
        $model = $request->all();
        $model['foto'] = null;

        if ($request->hasFile('foto')) {
        	$model['foto'] = '/upload/foto_user/'.str_slug($model['nm_user'],'-').'.'.$request->foto->getClientOriginalExtension();
        	$request->foto->move(public_path('/upload/foto_user'), $model['foto']);
        }

        User::create([
            'id_satuan_kerja'   => $model['id_satuan_kerja'],
            'nm_user'   => $model['nm_user'],
            'username'   => $model['username'],
            'level'   => $model['level'],
            'foto'   => $model['foto'],
            'password'   => bcrypt($model['password']),
        ]);
        return response()->json([
        	'success'	=> true
        ]);
        
    }

    public function edit($id)
    {
        $model = User::find($id);
        return $model;
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'id_satuan_kerja'    =>  'required|',
            'nm_user'    =>  'required|string|',
            'username'    =>  'required|string|',
            'password'    =>  'string|',
            'foto'        =>    'image|max:500',
            'level'      =>     'required',
        ]);

        $input = $request->all();
        $model = User::findOrFail($id);

        $input['foto'] = $model->foto;

        if ($request->hasFile('foto')) {
        	if ($model->foto != null) {
        		unlink(public_path($model->foto));
        	}
        	$input['foto'] = '/upload/foto_user/'.str_slug($input['username'],'-').'.'.$request->foto->getClientOriginalExtension();
        	$request->foto->move(public_path('/upload/foto_user'), $input['foto']);
        }

        $model->update($input);
        return response()->json([
        	'success'	=> true
        ]);
        
    }

    public function destroy($id)
    {
        $model = User::findOrFail($id);
        if ($model->foto != null) {
    		unlink(public_path($model->foto));
    	}

    	User::destroy($id);
    	return response()->json([
    		'success'	=>	true
    	]);
    }

    public function dataTable(){
        DB::statement(DB::raw('set @rownum=0'));
        $model = DB::table('tb_user')
                ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_user.id_satuan_kerja')
                ->select('tb_user.id','tb_satuan_kerja.id as id_satuan_kerja','tb_satuan_kerja.nm_satuan_kerja','nm_user','username','foto','level','tb_user.created_at',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                ->get();
        return DataTables::of($model)
                ->addColumn('foto',function($model){
                    if($model->foto == NULL){
                        return '<label class="badge badge-danger"><i class="fa fa-close"></i> Tidak Ada Foto</label>';
                    }
                    else
                    {
                        return '<img class="" width="50" height="50" src="'. url($model->foto) .'" alt="">';
                    }
                })
                ->addColumn('action', function($model){
                    return
                    '<a onclick="editUser('.$model->id.')"  class="btn btn-primary btn-xs btn-flat"><i class="fa fa-edit"></i></a> '.
                    '<a onclick="hapusUser('.$model->id.')" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-remove"></i></a> ';
                })->rawColumns(['foto','action'])->make(true);
    }
}
