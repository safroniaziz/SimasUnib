<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except(['logout','logoutAdmin']);
    }

    public function showAdminLoginForm(){
        return view('authAdmin.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:6'
        ]);
        $credential = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        // Attempt to log the user in
        if (Auth::guard('admin')->attempt($credential, $request->member)){
            // If login succesful, then redirect to their intended location
            return redirect()->intended(route('admin.dashboard'));
        }
        // If Unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('username', 'remember'));
    }

    protected function credentials(Request $request)
    {
        return [
            'username' => $request->username,
            'password' => $request->password,
        ];
    }

    public function username()
    {
        return 'username';
    }

}
