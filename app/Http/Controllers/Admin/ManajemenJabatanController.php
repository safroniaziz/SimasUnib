<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Model\Jabatan;
use DataTables;
use DB;
use Auth;

class ManajemenJabatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        return view('admin/manajemen_jabatan.index');
    }

    public function store(Request $request){
       
            
        $model = $request->all();
        
        Jabatan::create([
            'id_satuan_kerja'   => $model['id_satuan_kerja'],
            'nm_jabatan'   => $model['nm_jabatan'],
            'keterangan'   => $model['keterangan'],
        ]);
        return response()->json([
        	'success'	=> true
        ]);
        
    }

    public function edit($id)
    {
        $model = DB::table('tb_jabatan')
                ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_jabatan.id_satuan_kerja')
                ->select('tb_jabatan.id as id_jabatan','tb_satuan_kerja.id as id_satuan_kerja','nm_satuan_kerja','nm_jabatan','keterangan',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                ->where('tb_jabatan.id',$id)
                ->get();
        return $model;
    }

    public function update(Request $request, $id){
        $input = $request->all();
       
        $model = Jabatan::findOrFail($id);
        $model->update([
            'id_satuan_kerja'   => $input['id_satuan_kerja'],
            'nm_jabatan'   => $input['nm_jabatan'],
            'keterangan'   => $input['keterangan'],
        ]);
        return response()->json([
        	'success'	=> true
        ]);
    }

    public function destroy($id)
    {
        $model = Jabatan::findOrFail($id);
        if ($model->foto != null) {
    		unlink(public_path($model->foto));
    	}

    	Jabatan::destroy($id);
    	return response()->json([
    		'success'	=>	true
    	]);
    }

    public function cariNamaJabatan(Request $request){
        $data = DB::table('tb_jabatan')
                ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_jabatan.id_satuan_kerja')
                ->where('tb_satuan_kerja.id',$request->id_satuan_kerja)
                ->where('nm_jabatan',$request->nm_jabatan)
                ->select('nm_jabatan')->get();
        
        $datas = count($data);
        
        return response()->json($datas);
    }

    public function dataTable(){
        DB::statement(DB::raw('set @rownum=0'));
        $model = DB::table('tb_jabatan')
                ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_jabatan.id_satuan_kerja')
                ->select('tb_jabatan.id','nm_satuan_kerja','nm_satuan_kerja_singkat','nm_jabatan','keterangan',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                ->get();
        return DataTables::of($model)
                
                ->addColumn('action', function($model){
                    return
                    '<a onclick="editJabatan('.$model->id.')"  class="btn social-btn btn-primary " style="padding:5px;font-size:10px;"><i class="fa fa-edit"></i></a> '.
                    '<a onclick="hapusJabatan('.$model->id.')"  class="btn social-btn btn-danger " style="padding:5px;font-size:10px;"><i class="fa fa-remove"></i></a> ';
                })->rawColumns(['action'])->make(true);
    }
}
