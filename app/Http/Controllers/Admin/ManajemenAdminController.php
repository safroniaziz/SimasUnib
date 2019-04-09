<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Model\Admin;
use DataTables;
use DB;
use Auth;

class ManajemenAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin/manajemen_admin.index');
    }

    public function store(Request $request){
        $this->validate($request,[
            'nm_admin'    =>  'required|string|',
            'username'    =>  'required|string|unique:tb_admin,username',
            'email'    =>  'required|string|unique:tb_admin,username',
            'password'    =>  'required|string|',
            'foto'        =>    'image|max:500',
        ]);
            
        $model = $request->all();
        $model['foto'] = null;

        if ($request->hasFile('foto')) {
        	$model['foto'] = '/upload/foto_admin/'.str_slug($model['username'],'-').'.'.$request->foto->getClientOriginalExtension();
        	$request->foto->move(public_path('/upload/foto_admin'), $model['foto']);
        }

        Admin::create([
            'nm_admin'   => $model['nm_admin'],
            'username'   => $model['username'],
            'email'   => $model['email'],
            'foto'   => $model['foto'],
            'password'   => bcrypt($model['password']),
        ]);
        return response()->json([
        	'success'	=> true
        ]);
        
    }

    public function edit($id)
    {
        $model = Admin::find($id);
        return $model;
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'nm_admin'    =>  'required|string|',
            'username'    =>  'required|string|unique:tb_admin,id',
            'email'    =>  'required|string|unique:tb_admin,id',
            'password'    =>  'string|',
            'foto'        =>    'image|max:500',
        ]);

        $input = $request->all();
        $model = Admin::findOrFail($id);

        $input['foto'] = $model->foto;

        if ($request->hasFile('foto')) {
        	if ($model->foto != null) {
        		unlink(public_path($model->foto));
        	}
        	$input['foto'] = '/upload/foto_admin/'.str_slug($input['username'],'-').'.'.$request->foto->getClientOriginalExtension();
        	$request->foto->move(public_path('/upload/foto_admin'), $input['foto']);
        }

        $model->update($input);
        return response()->json([
        	'success'	=> true
        ]);
        
    }

    public function destroy($id)
    {
        $model = Admin::findOrFail($id);
        if ($model->foto != null) {
    		unlink(public_path($model->foto));
    	}

    	Admin::destroy($id);
    	return response()->json([
    		'success'	=>	true
    	]);
    }

    public function dataTable(){
        DB::statement(DB::raw('set @rownum=0'));
        $model = DB::table('tb_admin')
                ->select('id','nm_admin','username','password','foto','created_at',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
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
                    '<a onclick="editAdmin('.$model->id.')"  class="btn btn-primary btn-xs btn-flat"><i class="fa fa-edit"></i></a> '.
                    '<a onclick="hapusAdmin('.$model->id.')" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-remove"></i></a> ';
                })->rawColumns(['foto','action'])->make(true);
    }
}
