@if (Auth::guard('web')->check())
    @if(Auth::user()->level == "staf_tu")
            Login Sebagai TATA USAHA    
            @elseif(Auth::user()->level == "pimpinan")
                    Login Sebagai Pimpinan
    @endif
@endif

@if (Auth::guard('admin')->check())
        Login Sebagai Admin
@endif