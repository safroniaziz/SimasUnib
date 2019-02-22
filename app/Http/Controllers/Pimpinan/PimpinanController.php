<?php

namespace App\Http\Controllers\Pimpinan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

class PimpinanController extends Controller
{
    public function index()
    {
        if(!Gate::allows('isPimpinan')){
            return redirect()->back()->with('gagal-pimpinan', 'Anda tidak memiliki akses sebagai Pimpinan, silahkan logout dan login kembali sebagai admin'); 
        }
        return view('pimpinan/dashboard');
    }
}
