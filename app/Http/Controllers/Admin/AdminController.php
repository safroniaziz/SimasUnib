<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Redirect;

class AdminController extends Controller
{
    public function index()
    {
        if(!Gate::allows('isAdmin')){
            return redirect()->back()->with('gagal-admin', 'Anda tidak memiliki akses admin, silahkan logout dan login kembali sebagai admin'); 
        }
        return view('admin/dashboard');
    }
}
