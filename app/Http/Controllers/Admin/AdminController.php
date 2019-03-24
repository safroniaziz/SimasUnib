<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Redirect;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $jumlah_surat_masuk = Count(DB::table('tb_surat_masuk')->get());
        $jumlah_surat_masuk_belum_dibaca  = Count(DB::table('tb_surat_masuk')->where('status',0));
        $jumlah_surat_keluar = Count(DB::table('tb_surat_keluar')->get());
        $jumlah_user = Count(DB::table('tb_user')->get());
        $jumlah_satuan_kerja = Count(DB::table('tb_satuan_kerja')->get());

        return view('admin/dashboard',compact('jumlah_surat_masuk','jumlah_surat_masuk_belum_dibaca','jumlah_user','jumlah_satuan_kerja'));
    }
}
