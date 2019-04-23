<?php

namespace App\Http\Controllers\Pimpinan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use DataTables;
use DB;
use App\Model\SuratMasuk;
use Auth;

class SuratMasukInternalController extends Controller
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
        return view('pimpinan/surat_masuk.internal',compact('id_penerima_disposisi'));
    }

    public function teruskan($id)
    {
        $model = DB::table('tb_surat_masuk')
                ->join('tb_satuan_kerja as id_satker_pengirim_surat','id_satker_pengirim_surat.id','tb_surat_masuk.id_satker_pengirim_surat')
                ->join('tb_jenis_surat','tb_jenis_surat.id','tb_surat_masuk.id_jenis_surat')
                ->where('tb_surat_masuk.id',$id)
                ->select('tb_surat_masuk.id','tipe_surat','id_satker_pengirim_surat.id as id_satker_pengirim_surat','id_satker_pengirim_surat.nm_satuan_kerja as nm_satker_pengirim_surat','tb_jenis_surat.id as id_jenis_surat','tb_jenis_surat.jenis_surat','no_surat','perihal','tujuan','lampiran','catatan','sifat_surat','tanggal_surat','tb_surat_masuk.status',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                ->get();
        return $model;
    }

    public function teruskanUpdate(Request $request, $id){
        $model = SuratMasuk::findOrFail($id);
        $a = $request->all();
        $model->update($a);
        if($model){
            return 'a';
        }
    }


    public function datatable(){
        DB::statement(DB::raw('set @rownum=0'));
        $model = DB::table('tb_surat_masuk')
                ->leftJoin('tb_disposisi_surat_masuk','tb_disposisi_surat_masuk.id_surat_masuk','tb_surat_masuk.id')
                ->leftJoin('tb_user as id_penerima_disposisi','id_penerima_disposisi.id','tb_disposisi_surat_masuk.id_penerima_disposisi')
                ->join('tb_satuan_kerja as satker_pengirim_surat','satker_pengirim_surat.id','tb_surat_masuk.id_satker_pengirim_surat')
                ->join('tb_satuan_kerja as satker_penerima_surat','satker_penerima_surat.id','tb_surat_masuk.id_satker_penerima_surat')
                ->join('tb_user as id_pimpinan_penerima_surat','id_pimpinan_penerima_surat.id','tb_surat_masuk.id_pimpinan_penerima_surat')
                ->join('tb_jenis_surat','tb_jenis_surat.id','tb_surat_masuk.id_jenis_surat')
                ->leftJoin('tb_satuan_kerja','tb_satuan_kerja.id','tb_surat_masuk.id_satker_pengirim_surat')
                ->where('tb_surat_masuk.id_pimpinan_penerima_surat',Auth::user()->id)
                ->where('tb_surat_masuk.tipe_surat','internal')
                ->select('tb_surat_masuk.id','id_penerima_disposisi.nm_user as nm_penerima_disposisi','tb_surat_masuk.tipe_surat','satker_pengirim_surat.nm_satuan_kerja as nm_pengirim_surat',
                        'satker_penerima_surat.nm_satuan_kerja as nm_penerima_surat','tb_jenis_surat.jenis_surat','tb_surat_masuk.no_surat',
                        'perihal','tujuan','lampiran','catatan','tanggal_surat','sifat_surat',
                        'id_pimpinan_penerima_surat.nm_user as nm_pimpinan_penerima_surat',DB::raw('@rownum  := @rownum  + 1 AS rownum'))
                ->get();
        
        return DataTables::of($model)
                ->addColumn('action', function($model){
                    return
                    '<a onclick="teruskanSuratMasukInternal('.$model->id.')"  class="btn social-btn btn-success " style="padding:5px;font-size:10px;"><i class="fa fa-send-o"></i></a> ';
                    // '<a onclick="editSuratMasukInternal('.$model->id.')"  class="btn social-btn btn-primary " style="padding:5px;font-size:10px;"><i class="fa fa-edit"></i></a> '.
                    // '<a onclick="hapusSuratMasukInternal('.$model->id.')"  class="btn social-btn btn-danger " style="padding:5px;font-size:10px;"><i class="fa fa-remove"></i></a> ';
                })->make(true);
    }
}
