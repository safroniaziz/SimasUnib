<?php

namespace App\Http\Controllers\TataUsaha;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

class TataUsahaController extends Controller
{
    public function index(){
        if(!Gate::allows('isStafTu')){
            return redirect()->back()->with('gagal-staf-tu', 'Anda tidak memiliki akses sebagai staf tu, silahkan logout dan login kembali sebagai admin'); 
        }
        return view('staf_tu/dashboard');
    }
}
