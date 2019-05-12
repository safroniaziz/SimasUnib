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
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        if(empty($id)){
            $id_jabatan = DB::table('tb_jabatan')->select('id','nm_jabatan')->whereNotIn('id', function($q){
                $q->select('tb_user.id_jabatan')->from('tb_user')->join('tb_jabatan','tb_jabatan.id','tb_user.id_jabatan');
            })->get();
        }else{
            $id_jabatan = User::find($id);
        }
        return view('admin/manajemen_user.index',compact('id_jabatan','id_jabatan'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'nm_user'    =>  'required|string|',
            'nip'    =>  'required|string|',
            'username'    =>  'required|string|',
            'email'    =>  'required|email|string|unique:tb_user',
            'telephone'    =>  'string',
            'id_jabatan'    =>  'required|',
            'password'    =>  'required|string|',
            'foto'        =>    'image|max:500',
            'level_user'      =>     'required',
        ]);
            
        $model = $request->all();
        $model['foto'] = null;

        if ($request->hasFile('foto')) {
        	$model['foto'] = '/upload/foto_user/'.str_slug($model['nm_user'],'-').'.'.$request->foto->getClientOriginalExtension();
        	$request->foto->move(public_path('/upload/foto_user'), $model['foto']);
        }

        User::create([
            'nm_user'   => $model['nm_user'],
            'nip'   => $model['nip'],
            'username'   => $model['username'],
            'email'   => $model['email'],
            'id_jabatan'   => $model['id_jabatan'],
            'telephone'   => $model['telephone'],
            'level_user'   => $model['level_user'],
            'foto'   => $model['foto'],
            'password'   => bcrypt($model['password']),
        ]);
        return response()->json([
        	'success'	=> true
        ]);
        
    }

    public function edit($id)
    {
        $model = DB::table('tb_user')
                ->join('tb_jabatan','tb_jabatan.id','tb_user.id_jabatan')
                ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_jabatan.id_satuan_kerja')
                ->where('tb_user.id',$id)
                ->select('tb_user.id','nm_user','nip','username','email','status','tb_jabatan.nm_jabatan','tb_satuan_kerja.nm_satuan_kerja','telephone','foto','level_user','tb_user.created_at',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                ->get();
        return $model;
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'nm_user'    =>  'required|string|',
            'nip'    =>  'required|string|unique:tb_user,id',
            'username'    =>  'required|string|unique:tb_user,id',
            'email'    =>  'required|email|string|unique:tb_user,id',
            'telephone'    =>  'string',
            // 'id_jabatan'    =>  'required|',
            'password'    =>  'string|',
            'foto'        =>    'image|max:500',
            'level_user'      =>     'required',
        ]);

        $id_jabatan = DB::table('tb_user')
                    ->join('tb_jabatan','tb_jabatan.id','tb_user.id_jabatan')
                    ->where('tb_user.id',$id)
                    ->select('tb_jabatan.id as id_jabatan')
                    ->get();

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

        $model->update([
            'nm_user'   => $input['nm_user'],
            'nip'   => $input['nip'],
            'username'   => $input['username'],
            'email'   => $input['email'],
            'id_jabatan'   => $id_jabatan[0]->id_jabatan,
            'telephone'   => $input['telephone'],
            'level_user'   => $input['level_user'],
            'foto'   => $input['foto'],
            // 'password'   => bcrypt($input['password']),
        ]);
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

    public function setAktifStatus($id)
    {
        $user = User::find($id);
        $user->update([
            'status'    => '1',
        ]);
    }

    public function setNonaktifStatus($id)
    {
        $user = User::find($id);
        $user->update([
            'status'    => '0',
        ]);
    }

    public function cariNip(Request $request){
        $data = DB::table('tb_user')->select('nip')->where('nip',$request->nip)->get();
        
        $datas = count($data);
        
        return response()->json($datas);
    }

    public function cariUname(Request $request){
        $data = DB::table('tb_user')->select('username')->where('username',$request->username)->get();
        
        $datas = count($data);
        
        return response()->json($datas);
    }

    public function cariEmail(Request $request){
        $data = DB::table('tb_user')->select('email')->where('email',$request->email)->get();
        
        $datas = count($data);
        
        return response()->json($datas);
    }

    public function dataTable(){
        DB::statement(DB::raw('set @rownum=0'));
        $model = DB::table('tb_user')
                ->join('tb_jabatan','tb_jabatan.id','tb_user.id_jabatan')
                ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_jabatan.id_satuan_kerja')
                ->select('tb_user.id','nm_user','nip','username','email','status','tb_jabatan.nm_jabatan','tb_satuan_kerja.nm_satuan_kerja_singkat','telephone','foto','level_user','tb_user.created_at',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
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

                ->addColumn('ubah_status',function($model){
                    if($model->status == 1)
                    {
                        return 
                       '<a onclick="setNonaktifStatus('.$model->id.')"  class="btn social-btn btn-danger " style="padding:5px;font-size:10px;"><i class="fa fa-thumbs-o-down"></i></a> ';
                    }
                    else
                    {
                        return 
                        '<a onclick="setAktifStatus('.$model->id.')"  class="btn social-btn btn-primary " style="padding:5px;font-size:10px;"><i class="fa fa-thumbs-o-up"></i></a> ';
                    }                    
                })

                ->addColumn('action', function($model){
                    return
                    '<a onclick="editUser('.$model->id.')"  class="btn social-btn btn-primary " style="padding:5px;font-size:10px;"><i class="fa fa-edit"></i></a> '.
                    '<a onclick="hapusUser('.$model->id.')"  class="btn social-btn btn-danger " style="padding:5px;font-size:10px;"><i class="fa fa-remove"></i></a> ';
                })->rawColumns(['foto','action','ubah_status'])->make(true);
    }
}
