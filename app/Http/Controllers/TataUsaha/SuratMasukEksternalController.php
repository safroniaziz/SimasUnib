<?php

namespace App\Http\Controllers\TataUsaha;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Model\SuratMasuk;
use App\Model\DisposisiSuratMasuk;
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
        // $waktu2 = $waktu->toDateString();
        $id_user = DB::table('tb_user')
                    ->join('tb_jabatan','tb_jabatan.id','tb_user.id_jabatan')
                    ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_jabatan.id_satuan_kerja')
                    ->where('tb_user.id',Auth::user()->id)
                    ->select('tb_satuan_kerja.id')->pluck('tb_satuan_kerja.id');
        $id_penerima = DB::table('tb_satuan_kerja')
                    ->where('tb_satuan_kerja.id',$id_user[0])
                    ->select('tb_satuan_kerja.id as id_satuan_kerja')
                    ->pluck('tb_satuan_kerja.id_satuan_kerja');
        $id_penerima_disposisi = DB::table('tb_user')
                    ->join('tb_jabatan','tb_jabatan.id','tb_user.id_jabatan')
                    ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_jabatan.id_satuan_kerja')
                    ->where('tb_satuan_kerja.id',$id_user[0])
                    ->where('tb_user.id','!=',Auth::user()->id)
                    ->where('tb_user.level_user','!=','staf_tu')
                    ->select('tb_user.id','tb_user.nm_user','tb_jabatan.nm_jabatan as jabatan_user')
                    ->get();
        return view('staf_tu/surat_masuk.eksternal',compact('waktu2','id_penerima','id_penerima_disposisi'));
    }

    public function store(Request $request){
        // $this->validate($request,[
        //     'tujuan'    =>  'required|',
        // ]);
            
        $model = $request->all();
        // $model['foto'] = null;
        $model['lampiran'] = null;

        if ($request->hasFile('lampiran')) {
        	$model['lampiran'] = '/upload/foto_surat_masuk_eksternal/'.str_slug($model['no_surat'],'-').'.'.$request->lampiran->getClientOriginalExtension();
        	$request->lampiran->move(public_path('/upload/foto_surat_masuk_eksternal'), $model['lampiran']);
        }

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
                'id_satker_penerima_surat'   => $model['id_satker_penerima_surat'],
                'no_surat'   => $model['no_surat'],
                'perihal'   => $model['perihal'],
                'tujuan'   => $model['tujuan'],
                'lampiran'   => $model['lampiran'],
                'catatan'   => $model['catatan'],
                'sifat_surat'   => $model['sifat_surat'],
                'tanggal_surat'   => $model['tanggal_surat'],
            ]);
        }
        else{
            SuratMasuk::create([
                'tipe_surat'   => "internal",
                'id_satker_pengirim_surat'   => $model['id_satker_pengirim_surat'],
                'id_satker_penerima_surat'   => $model['id_satker_penerima_surat'],
                'pengirim_surat'   => $pengirim_surat[0],
                'id_jenis_surat'   => $model['id_jenis_surat'],
                'no_surat'   => $model['no_surat'],
                'perihal'   => $model['perihal'],
                'tujuan'   => $model['tujuan'],
                'lampiran'   => $model['lampiran'],
                'catatan'   => $model['catatan'],
                'sifat_surat'   => $model['sifat_surat'],
                'tanggal_surat'   => $model['tanggal_surat'],
            ]);
        }
        
        return redirect()->back()->with('success', 'Surat baru sudah ditambahkan, namun belum di disposisi !!'); 
        
    }

    public function teruskan($id)
    {
        $model = DB::table('tb_surat_masuk')
                ->join('tb_jenis_surat','tb_jenis_surat.id','tb_surat_masuk.id_jenis_surat')
                ->where('tb_surat_masuk.id',$id)
                ->select('tb_surat_masuk.id','tipe_surat','tb_surat_masuk.pengirim_surat as institusi_pengirim_surat','tb_jenis_surat.id as id_jenis_surat','tb_jenis_surat.jenis_surat','no_surat','perihal','tujuan','lampiran','catatan','sifat_surat','tanggal_surat',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                ->get();
                // dd($model);
        return $model;
    }

    public function teruskanSurat(Request $request){
        $a = SuratMasuk::findOrFail($request->id_surat_masuk);
        $a->update(['status_teruskan'   =>1,]);
        $model = DisposisiSuratMasuk::create([
            'id_surat_masuk' =>  $request->id_surat_masuk,
            'id_pengirim_disposisi' =>  $request->id_pengirim_disposisi,
            'id_penerima_disposisi' =>  $request->id_pimpinan_penerima_surat,
        ]);
        return response()->json([
        	'success'	=> true
        ]);

    }

    public function edit($id)
    {
        $model = SuratMasuk::find($id);
        return $model;
    }

    public function update(Request $request, $id){
        $input = $request->all();
        $model = SuratMasuk::findOrFail($id);

        $input['lampiran'] = $model->lampiran;

        if ($request->hasFile('lampiran')) {
        	if ($model->lampiran != null) {
        		unlink(public_path($model->lampiran));
        	}
        	$input['lampiran'] = '/upload/foto_surat_masuk_eksternal/'.str_slug($input['no_surat'],'-').'.'.$request->lampiran->getClientOriginalExtension();
        	$request->lampiran->move(public_path('/upload/foto_surat_masuk_eksternal'), $input['lampiran']);
        }

        $pengirim_surat = DB::table('tb_satuan_kerja')
        ->where('id',$request->id_satker_pengirim_surat)
        ->select('nm_satuan_kerja')->pluck('nm_satuan_kerja');
        
        // dd($pengirim_surat); 
        if(empty($request->id_satker_pengirim_surat)){
            $model->update([
                'tipe_surat'   => "eksternal",
                'id_pengirim_surat'   => null,
                'pengirim_surat'   => $input['pengirim_surat'],
                'id_jenis_surat'   => $input['id_jenis_surat'],
                'id_satker_penerima_surat'   => $input['id_satker_penerima_surat'],
                'no_surat'   => $input['no_surat'],
                'perihal'   => $input['perihal'],
                'tujuan'   => $input['tujuan'],
                'lampiran'   => $input['lampiran'],
                'catatan'   => $input['catatan'],
                'sifat_surat'   => $input['sifat_surat'],
                'tanggal_surat'   => $input['tanggal_surat'],
            ]);
        }
        else{
            $model->update([
                'tipe_surat'   => "internal",
                'id_satker_pengirim_surat'   => $input['id_satker_pengirim_surat'],
                'id_satker_penerima_surat'   => $input['id_satker_penerima_surat'],
                'pengirim_surat'   => $pengirim_surat[0],
                'id_jenis_surat'   => $input['id_jenis_surat'],
                'no_surat'   => $input['no_surat'],
                'perihal'   => $input['perihal'],
                'tujuan'   => $input['tujuan'],
                'lampiran'   => $input['lampiran'],
                'catatan'   => $input['catatan'],
                'sifat_surat'   => $input['sifat_surat'],
                'tanggal_surat'   => $input['tanggal_surat'],
            ]);
        }
    }

    public function destroy($id)
    {
        $model = SuratKeluar::findOrFail($id);
        if ($model->foto != null) {
    		unlink(public_path($model->foto));
    	}

    	SuratKeluar::destroy($id);
    	return response()->json([
    		'success'	=>	true
    	]);
    }

    public function dataTable(){
        DB::statement(DB::raw('set @rownum=0'));
        $id_satuan_kerja = DB::table('tb_user')
                    ->join('tb_jabatan','tb_jabatan.id','tb_user.id_jabatan')
                    ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_jabatan.id_satuan_kerja')
                    ->where('tb_user.id',Auth::user()->id)
                    ->select('tb_satuan_kerja.id as id_satuan_kerja')->pluck('tb_satuan_kerja.id_satuan_kerja');
        $model = DB::table('tb_surat_masuk')
                ->leftJoin('tb_disposisi_surat_masuk','tb_disposisi_surat_masuk.id_surat_masuk','tb_surat_masuk.id')
                ->join('tb_jenis_surat','tb_jenis_surat.id','tb_surat_masuk.id_jenis_surat')
                ->join('tb_satuan_kerja as id_satker_penerima_surat','id_satker_penerima_surat.id','tb_surat_masuk.id_satker_penerima_surat')
                ->where('tb_surat_masuk.tipe_surat','eksternal')
                ->where('id_satker_penerima_surat.id',$id_satuan_kerja[0])
                ->select('tb_surat_masuk.id','tipe_surat','tb_surat_masuk.pengirim_surat','id_satker_penerima_surat.nm_satuan_kerja_singkat as satuan_kerja_penerima_surat','tb_jenis_surat.jenis_surat','no_surat','perihal','tujuan','lampiran','catatan','sifat_surat','tanggal_surat','tb_surat_masuk.status_teruskan','tb_disposisi_surat_masuk.status_baca',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                ->get();
                // dd($model);
        return DataTables::of($model)
                ->addColumn('lampiran',function($model){
                    if($model->lampiran == NULL){
                        return '<label class="badge badge-danger"><i class="fa fa-close"></i> Tidak Ada Foto</label>';
                    }
                    else
                    {
                        return '<img class="" width="50" height="50" src="'. url($model->lampiran) .'" alt="">';
                    }
                })
                ->addColumn('action', function($model){
                    if($model->status_teruskan == 1){
                        return
                        '<a onclick="teruskanSuratMasukEksternal('.$model->id.')"  class="btn social-btn btn-secondary " style="padding:5px;font-size:10px; pointer-events: none;"><i class="fa fa-send-o"></i></a> '.
                        '<a onclick="editSuratMasukEksternal('.$model->id.')"  class="btn social-btn btn-primary " style="padding:5px;font-size:10px;"><i class="fa fa-edit"></i></a> '.
                        '<a onclick="hapusSuratMasukEksternal('.$model->id.')"  class="btn social-btn btn-danger " style="padding:5px;font-size:10px;"><i class="fa fa-remove"></i></a> ';    
                    } else{
                        return
                        '<a onclick="teruskanSuratMasukEksternal('.$model->id.')"  class="btn social-btn btn-success " style="padding:5px;font-size:10px;"><i class="fa fa-send-o"></i></a> '.
                        '<a onclick="editSuratMasukEksternal('.$model->id.')"  class="btn social-btn btn-primary " style="padding:5px;font-size:10px;"><i class="fa fa-edit"></i></a> '.
                        '<a onclick="hapusSuratMasukEksternal('.$model->id.')"  class="btn social-btn btn-danger " style="padding:5px;font-size:10px;"><i class="fa fa-remove"></i></a> ';
                    }
                })->rawColumns(['lampiran','action'])->make(true);
    }
}
