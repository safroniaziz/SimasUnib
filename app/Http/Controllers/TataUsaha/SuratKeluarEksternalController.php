<?php

namespace App\Http\Controllers\TataUsaha;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SuratKeluar;
use App\Model\SuratMasuk;
use DB;
use Auth;
use DataTables;

class SuratKeluarEksternalController extends Controller
{
    public function index(){
        $id_user = DB::table('tb_user')
                    ->join('tb_jabatan','tb_jabatan.id','tb_user.id_jabatan')
                    ->join('tb_satuan_kerja','tb_satuan_kerja.id','tb_jabatan.id_satuan_kerja')
                    ->where('tb_user.id',Auth::user()->id)
                    ->select('tb_satuan_kerja.id')->pluck('tb_satuan_kerja.id');
                    // dd($id_user);
        $id_penerima = DB::table('tb_satuan_kerja')
                    ->where('tb_satuan_kerja.id','!=',$id_user[0])
                    ->select('tb_satuan_kerja.id','tb_satuan_kerja.nm_satuan_kerja','tb_satuan_kerja.nm_satuan_kerja_singkat')
                    ->get();
        
        $id_pengirim = DB::table('tb_satuan_kerja')
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
        
        return view('staf_tu/surat_keluar.eksternal',compact('waktu2','id_penerima','id_pengirim','id_penerima_disposisi'));
    }

    public function store(Request $request){
        // $this->validate($request,[
        //     'tujuan'    =>  'required|',
        // ]);
        // dd($request->all());
        $model = $request->all();
        // $model['foto'] = null;
        $model['lampiran'] = null;

        if ($request->hasFile('lampiran')) {
        	$model['lampiran'] = '/upload/foto_surat_keluar/internal/'.str_slug($model['no_surat'],'-').'.'.$request->lampiran->getClientOriginalExtension();
        	$request->lampiran->move(public_path('/upload/foto_surat_keluar/internal'), $model['lampiran']);
        }

        $penerima_surat = DB::table('tb_satuan_kerja')
        ->where('id',$request->id_satuan_kerja_penerima)
        ->select('nm_satuan_kerja')->pluck('nm_satuan_kerja');
        
        // dd($pengirim_surat); 
        if(empty($request->id_satuan_kerja_penerima)){
            SuratKeluar::create([
                'tipe_surat'   => "eksternal",
                'id_pengirim_surat'   => null,
                'penerima_surat'   => $model['penerima_surat'],
                'id_jenis_surat'   => $model['id_jenis_surat'],
                'id_satuan_kerja_pengirim'   => $model['id_satuan_kerja_pengirim'],
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
            SuratKeluar::create([
                'tipe_surat'   => "internal",
                'id_satuan_kerja_pengirim'   => $model['id_satuan_kerja_pengirim'],
                'id_satuan_kerja_penerima'   => $model['id_satuan_kerja_penerima'],
                'penerima_surat'   => $penerima_surat[0],
                'id_jenis_surat'   => $model['id_jenis_surat'],
                'no_surat'   => $model['no_surat'],
                'perihal'   => $model['perihal'],
                'tujuan'   => $model['tujuan'],
                'lampiran'   => $model['lampiran'],
                'catatan'   => $model['catatan'],
                'sifat_surat'   => $model['sifat_surat'],
                'tanggal_surat'   => $model['tanggal_surat'],

                SuratMasuk::create([
                    'tipe_surat'   => "internal",
                    'id_satker_pengirim_surat'   => $model['id_satuan_kerja_pengirim'],
                    'id_satker_penerima_surat'   => $model['id_satuan_kerja_penerima'],
                    'pengirim_surat'   => $penerima_surat[0],
                    'id_jenis_surat'   => $model['id_jenis_surat'],
                    'no_surat'   => $model['no_surat'],
                    'perihal'   => $model['perihal'],
                    'tujuan'   => $model['tujuan'],
                    'lampiran'   => $model['lampiran'],
                    'catatan'   => $model['catatan'],
                    'sifat_surat'   => $model['sifat_surat'],
                    'tanggal_surat'   => $model['tanggal_surat'],
                    'status_pengiriman' => 1,
                ])
            ]);
        }
        
        // return redirect()->back()->with('success', 'Surat baru sudah ditambahkan, namun belum di disposisi !!'); 
        
    }

    public function edit($id)
    {
        $model = SuratKeluar::find($id);
        return $model;
    }

    public function update(Request $request, $id){
        $input = $request->all();
        $model = SuratKeluar::findOrFail($id);

        $input['lampiran'] = $model->lampiran;

        if ($request->hasFile('lampiran')) {
        	if ($model->lampiran != null) {
        		unlink(public_path($model->lampiran));
        	}
        	$input['lampiran'] = '/upload/foto_surat_keluar/internal/'.str_slug($input['no_surat'],'-').'.'.$request->lampiran->getClientOriginalExtension();
        	$request->lampiran->move(public_path('/upload/foto_surat_keluar/internal'), $input['lampiran']);
        }

        $penerima_surat = DB::table('tb_satuan_kerja')
        ->where('id',$request->id_satuan_kerja_penerima)
        ->select('nm_satuan_kerja')->pluck('nm_satuan_kerja');
        
        // dd($pengirim_surat); 
        if(empty($request->id_satuan_kerja_penerima)){
            $model->update([
                'tipe_surat'   => "eksternal",
                'id_pengirim_surat'   => null,
                'penerima_surat'   => $input['penerima_surat'],
                'id_jenis_surat'   => $input['id_jenis_surat'],
                'id_satuan_kerja_pengirim'   => $model['id_satuan_kerja_pengirim'],
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
                'id_satuan_kerja_pengirim'   => $input['id_satuan_kerja_pengirim'],
                'id_satuan_kerja_penerima'   => $input['id_satuan_kerja_penerima'],
                'penerima_surat'   => $penerima_surat[0],
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
        return response()->json([
        	'success'	=> true
        ]);
    }

    public function destroy($id)
    {
        $model = SuratKeluar::findOrFail($id);
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
        $model = DB::table('tb_surat_keluar')
                    ->join('tb_jenis_surat','tb_jenis_surat.id','tb_surat_keluar.id_jenis_surat')
                    ->join('tb_satuan_kerja as id_satuan_kerja_pengirim','id_satuan_kerja_pengirim.id','tb_surat_keluar.id_satuan_kerja_pengirim')
                    ->where('tb_surat_keluar.tipe_surat','eksternal')
                    ->where('id_satuan_kerja_pengirim.id',$id_satuan_kerja[0])
                    ->select('tb_surat_keluar.id','tipe_surat','id_satuan_kerja_pengirim.nm_satuan_kerja_singkat as satker_pengirim_surat','penerima_surat as satker_penerima_surat','tb_jenis_surat.jenis_surat','no_surat','perihal','tujuan','lampiran','catatan','sifat_surat','tanggal_surat','tb_surat_keluar.status',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                    ->get();
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
                        return
                        '<a onclick="editSuratKeluarEksternal('.$model->id.')"  class="btn social-btn btn-primary " style="padding:5px;font-size:10px;"><i class="fa fa-edit"></i></a> '.
                        '<a onclick="hapusSuratKeluarEksternal('.$model->id.')"  class="btn social-btn btn-danger " style="padding:5px;font-size:10px;"><i class="fa fa-remove"></i></a> ';
                })->rawColumns(['lampiran','action'])->make(true);
    }
}
