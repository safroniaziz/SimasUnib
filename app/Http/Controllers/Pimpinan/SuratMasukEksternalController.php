<?php

namespace App\Http\Controllers\Pimpinan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use DataTables;
use DB;
// use App\Model\SuratMasuk;
use App\Model\DisposisiSuratMasuk;
use Auth;

class SuratMasukEksternalController extends Controller
{
    public function index(){
        if(!Gate::allows('isPimpinan')){
            return redirect()->back()->with('gagal-pimpinan', 'Anda tidak memiliki akses sebagai pimpinan, silahkan logout dan login kembali sebagai admin'); 
        }
        $id_penerima_disposisi = DB::table('tb_pejabat_disposisi')
                                ->join('tb_user','tb_user.id','tb_pejabat_disposisi.id_disposisi_pejabat')
                                ->join('tb_jabatan','tb_jabatan.id','tb_user.id_jabatan')
                                ->where('tb_pejabat_disposisi.id_pejabat',Auth::user()->id)
                                ->where("tb_user.level_user",'!=','staf_tu')
                                ->select('tb_user.id','tb_user.nm_user','tb_jabatan.nm_jabatan')
                                ->get();
                                // dd($id_penerima_disposisi);
        return view('pimpinan/surat_masuk.eksternal',compact('id_penerima_disposisi'));
    }

    public function teruskan($id)
    {
        $model = DB::table('tb_disposisi_surat_masuk')
                ->rightJoin('tb_surat_masuk','tb_surat_masuk.id','tb_disposisi_surat_masuk.id_surat_masuk')
                ->rightJoin('tb_user as id_pengirim_disposisi','id_pengirim_disposisi.id','tb_disposisi_surat_masuk.id_pengirim_disposisi')
                ->join('tb_jenis_surat','tb_jenis_surat.id','tb_surat_masuk.id_jenis_surat')
                ->where('tb_disposisi_surat_masuk.id_penerima_disposisi',Auth::user()->id)
                ->select('tb_disposisi_surat_masuk.id as id_disposisi_surat_masuk','tb_surat_masuk.id','id_pengirim_disposisi.nm_user as nm_pengirim_disposisi','tb_surat_masuk.pengirim_surat',
                            'tb_surat_masuk.no_surat','tb_jenis_surat.jenis_surat',
                            'tb_surat_masuk.perihal','tb_surat_masuk.tujuan','tb_surat_masuk.lampiran','tb_surat_masuk.catatan',
                            'tb_surat_masuk.tanggal_surat','tb_surat_masuk.sifat_surat','tb_surat_masuk.tipe_surat',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                ->get();
        return $model;
    }

    public function teruskanSurat(Request $request){
        $a = DisposisiSuratMasuk::findOrFail($request->id_disposisi_surat_masuk);
        $a->update(['status_teruskan'   =>'1',]);

        $model = DisposisiSuratMasuk::create([
            'id_surat_masuk' =>  $request->id_surat_masuk,
            'id_pengirim_disposisi' =>  $request->id_pengirim_disposisi,
            'id_penerima_disposisi' =>  $request->id_pimpinan_penerima_surat,
        ]);
        return response()->json([
        	'success'	=> true
        ]);
    }


    public function datatable(){
        // dd(Auth::user()->id);
        DB::statement(DB::raw('set @rownum=0'));
        $model = DB::table('tb_disposisi_surat_masuk')
                ->rightJoin('tb_surat_masuk','tb_surat_masuk.id','tb_disposisi_surat_masuk.id_surat_masuk')
                ->rightJoin('tb_user as id_pengirim_disposisi','id_pengirim_disposisi.id','tb_disposisi_surat_masuk.id_pengirim_disposisi')
                ->join('tb_jenis_surat','tb_jenis_surat.id','tb_surat_masuk.id_jenis_surat')
                ->where('tb_disposisi_surat_masuk.id_penerima_disposisi',Auth::user()->id)
                ->where('tb_surat_masuk.tipe_surat','eksternal')
                ->select('tb_disposisi_surat_masuk.id','tb_disposisi_surat_masuk.status_teruskan','tb_surat_masuk.id as id_surat_masuk','id_pengirim_disposisi.nm_user as nm_pengirim_disposisi','tb_surat_masuk.pengirim_surat',
                            'tb_surat_masuk.no_surat','tb_jenis_surat.jenis_surat',
                            'tb_surat_masuk.perihal','tb_surat_masuk.tujuan','tb_surat_masuk.lampiran','tb_surat_masuk.catatan',
                            'tb_surat_masuk.tanggal_surat','tb_surat_masuk.sifat_surat',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
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
                   if($model->status_teruskan == 1){
                        return
                        '<a onclick="teruskanSuratMasukEksternalPimpinan('.$model->id.')"  class="btn social-btn btn-secondary " style="padding:5px;font-size:10px; pointer-events: none;"><i class="fa fa-send-o"></i></a> ';
                    } else{
                        return
                        '<a onclick="teruskanSuratMasukEksternalPimpinan('.$model->id.')"  class="btn social-btn btn-success " style="padding:5px;font-size:10px;"><i class="fa fa-send-o"></i></a> ';
                    }
                })->rawColumns(['lampiran','action'])->make(true);
    }
}
