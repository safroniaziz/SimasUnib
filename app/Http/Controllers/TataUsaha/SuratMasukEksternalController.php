<?php

namespace App\Http\Controllers\TataUsaha;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Model\SuratMasuk;
use DataTables;
use DB;
use Auth;
use Carbon;

class SuratMasukEksternalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $waktu = Carbon\Carbon::now();
        $waktu2 = $waktu->toDateString();
        return view('staf_tu/surat_masuk.eksternal',compact('waktu2'));
    }

    public function store(Request $request){
        // $this->validate($request,[
        //     'tujuan'    =>  'required|',
        // ]);
            
        $model = $request->all();
        // $model['foto'] = null;

        $pengirim_surat = DB::table('tb_user')
        ->where('id',$request->id_pengirim_surat)
        ->select('nm_user')->pluck('nm_user');
        
        // dd($pengirim_surat); 
        if(empty($request->id_pengirim_surat)){
            SuratMasuk::create([
                'tipe_surat'   => "eksternal",
                'id_pengirim_surat'   => null,
                'pengirim_surat'   => $model['pengirim_surat'],
                'id_jenis_surat'   => $model['id_jenis_surat'],
                'no_surat'   => $model['no_surat'],
                'perihal'   => $model['perihal'],
                'tujuan'   => $model['tujuan'],
                'lampiran'   => $request->lampiran,
                'catatan'   => $model['catatan'],
                'sifat_surat'   => $model['sifat_surat'],
                'tanggal_surat'   => $model['tanggal_surat'],
            ]);
        }
        else{
            SuratMasuk::create([
                'tipe_surat'   => "internal",
                'id_pengirim_surat'   => $model['id_pengirim_surat'],
                'pengirim_surat'   => $pengirim_surat[0],
                'id_jenis_surat'   => $model['id_jenis_surat'],
                'no_surat'   => $model['no_surat'],
                'perihal'   => $model['perihal'],
                'tujuan'   => $model['tujuan'],
                'lampiran'   => $request->lampiran,
                'catatan'   => $model['catatan'],
                'sifat_surat'   => $model['sifat_surat'],
                'tanggal_surat'   => $model['tanggal_surat'],
            ]);
        }
        
        return redirect()->back()->with('success', 'Surat baru sudah ditambahkan, namun belum di disposisi !!'); 
        
    }

    public function edit($id)
    {
        $model = SuratMasuk::find($id);
        return $model;
    }

    public function update(Request $request, $id){
        // $this->validate($request,[
        //     'id_satuan_kerja'    =>  'required|',
        //     'nm_user'    =>  'required|string|',
        //     'nip'    =>  'required|string|unique:tb_user,id',
        //     'username'    =>  'required|string|unique:tb_user,id',
        //     'email'    =>  'required|email|string|unique:tb_user,id',
        //     'telephone'    =>  'string',
        //     'id_jabatan'    =>  'required|',
        //     'password'    =>  'string|',
        //     'foto'        =>    'image|max:500',
        //     'level'      =>     'required',
        // ]);

        $input = $request->all();
        $model = SuratMasuk::findOrFail($id);

        // $input['foto'] = $model->foto;

        // if ($request->hasFile('foto')) {
        // 	if ($model->foto != null) {
        // 		unlink(public_path($model->foto));
        // 	}
        // 	$input['foto'] = '/upload/foto_user/'.str_slug($input['username'],'-').'.'.$request->foto->getClientOriginalExtension();
        // 	$request->foto->move(public_path('/upload/foto_user'), $input['foto']);
        // }

        $model->update($input);
        return response()->json([
        	'success'	=> true
        ]);
        
    }

    public function destroy($id)
    {
        $model = SuratMasuk::findOrFail($id);
        if ($model->foto != null) {
    		unlink(public_path($model->foto));
    	}

    	SuratMasuk::destroy($id);
    	return response()->json([
    		'success'	=>	true
    	]);
    }

    public function dataTable(){
        DB::statement(DB::raw('set @rownum=0'));
        $model = DB::table('tb_surat_masuk')
                ->join('tb_jenis_surat','tb_jenis_surat.id','tb_surat_masuk.id_jenis_surat')
                ->where('tb_surat_masuk.tipe_surat','eksternal')
                ->select('tb_surat_masuk.id','tipe_surat','tb_surat_masuk.pengirim_surat','tb_jenis_surat.jenis_surat','no_surat','perihal','tujuan','lampiran','catatan','sifat_surat','tanggal_surat','tb_surat_masuk.status',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                ->get();
        return DataTables::of($model)
                ->addColumn('action', function($model){
                    return
                    '<a onclick="teruskanSuratMasukInternal('.$model->id.')"  class="btn social-btn btn-success " style="padding:5px;font-size:10px;"><i class="fa fa-edit"></i></a> '.
                    '<a onclick="editSuratMasukEksternal('.$model->id.')"  class="btn social-btn btn-primary " style="padding:5px;font-size:10px;"><i class="fa fa-edit"></i></a> '.
                    '<a onclick="hapusSuratMasukEksternal('.$model->id.')"  class="btn social-btn btn-danger " style="padding:5px;font-size:10px;"><i class="fa fa-remove"></i></a> ';
                })->make(true);
    }
}
