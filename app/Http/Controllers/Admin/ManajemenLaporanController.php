<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ManajemenLaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function laporan(){
        return view('admin/laporan.index');
    }

    public function laporanIndex(){
        if (isset($_GET['tipe_surat'])) {
            if($_GET['tipe_surat']=="masuk"){
                $surat = DB::table('tb_surat_masuk')
                        ->join('tb_satuan_kerja as pengirim','pengirim.id','tb_surat_masuk.id_satker_pengirim_surat')
                        ->join('tb_satuan_kerja as penerima','penerima.id','tb_surat_masuk.id_satker_penerima_surat')
                        ->select('pengirim.nm_satuan_kerja as pengirim','penerima.nm_satuan_kerja as penerima','no_surat','perihal','tujuan')
                        ->get();
            }
            elseif($_GET['tipe_surat'] == "keluar"){
                $surat = DB::table('tb_surat_keluar')
                        ->join('tb_satuan_kerja as pengirim','pengirim.id','tb_surat_keluar.id_satuan_kerja_pengirim')
                        ->join('tb_satuan_kerja as penerima','penerima.id','tb_surat_keluar.id_satuan_kerja_penerima')
                        ->select('pengirim.nm_satuan_kerja as pengirim','penerima.nm_satuan_kerja as penerima','no_surat','perihal','tujuan')
                        ->get();
            }

            return view('admin/laporan.index')->with('data',$surat);
        }
    }
}
