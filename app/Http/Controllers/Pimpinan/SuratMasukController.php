<?php

namespace App\Http\Controllers\Pimpinan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

class SuratMasukController extends Controller
{
    public function index(){
        if(!Gate::allows('isPimpinan')){
            return redirect()->back()->with('gagal-pimpinan', 'Anda tidak memiliki akses sebagai pimpinan, silahkan logout dan login kembali sebagai admin'); 
        }
        return view('pimpinan/surat_masuk.index');
    }
}
