
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Simas Unib | @yield('page-title')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/iconfonts/puse-icons-feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/css/vendor.bundle.addons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/css/vendor.bundle.addons.css') }}">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
  @stack('styles')
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/template/css/shared/style.css') }}">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{ asset('assets/template/css/demo_1/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- End Layout styles -->
  <link rel="shortcut icon" href="{{ asset('assets/img/logo-utama.png') }}" />
  <style>
    td{
      height:0px !important;
      overflow: hidden;
      font-size:11px !important;
    }
    
    th{
      height:0px !important;
    }

    .tr-header{
      font-weight:bold;
    }

    .sidebar-dark .sidebar .nav .nav-item.active > .nav-link {
        color: white !important;
    }

    .sidebar-dark .sidebar .nav .nav-item .nav-link[aria-expanded="true"] {
        background: #2e3657;
        border-left:2px white solid;
    }

    .nav-item a, i{
      color:white !important;
    }

    .nav-item .dropdown-item{
      color:black !important;
    }

    .sidebar .nav .nav-item .nav-link{
      padding:16px 15px;
    }

    .sidebar .nav .nav-item .nav-link .menu-title{
      font-size: 12px;
    }

    .sidebar .nav .nav-item .nav-link i.menu-arrow:before{
      color:white;
      font-size:5px !important;
    }

    .badge{
      font-size: 11px !important;
    }

    input, textarea, select,  input[type="file"]  {
	padding: 2px;
  color: #333;
  height:45px !important;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 15px;
	line-height: 16px;
	background: #fafafa;
	border: 1px solid #ccc;
	outline: 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -ms-sizing: border-box;
        box-sizing: border-box;
}

    table td img{
      width: 50px !important;
      height: 50px !important;
      border-radius: unset !important;
    }

  </style>
</head>

<body class="sidebar-fixed ">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="background: #252C46; border-bottom:1px white solid;">
        <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}" style="color:white;line-height:55px;">
          <img src="{{ asset('assets/img/logo-utama.png') }}" style="width:30px;" alt="">&nbsp; SIMAS UNIB
        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}">
          <i class="mdi mdi-home text-white"></i>  
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown ml-4">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell-outline"></i>
              <span class="count bg-success">4</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
              <a class="dropdown-item py-3 border-bottom">
                <p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>
                <span class="badge badge-pill badge-primary float-right">View all</span>
              </a>
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-alert m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal text-dark mb-1">Application Error</h6>
                  <p class="font-weight-light small-text mb-0"> Just now </p>
                </div>
              </a>
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-settings m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal text-dark mb-1">Settings</h6>
                  <p class="font-weight-light small-text mb-0"> Private message </p>
                </div>
              </a>
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-airballoon m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal text-dark mb-1">New user registration</h6>
                  <p class="font-weight-light small-text mb-0"> 2 days ago </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text" style="text-transform:uppercase;">
                @if(Auth::guard('admin')->check())
                  {{ Auth::guard('admin')->user()->nm_admin }}
                    @else
                      {{ Auth::user()->nm_user }}
                @endif
                !</span>
            <img class="img-xs rounded-circle" src="
            @if(Auth::guard('admin')->check())
              {{ Auth::guard('admin')->user()->foto }}
                @else
                  {{ Auth::user()->foto }}
                
            @endif
            " alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown p-0" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-2 text-primary" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                  <i class="fa fa-power-off text-danger"></i>{{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper  sidebar-dark">
      <!-- partial:partials/_settings-panel.html -->
      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background:">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link"  style="flex-direction:unset !important;">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="
                    @if(Auth::guard('admin')->check())
                      {{ Auth::guard('admin')->user()->foto }}
                        @else
                          {{ Auth::user()->foto }}
                    @endif
                  " alt="profile image" style="max-width:100% !important; height:39px !important;"> </div>
                <div class="text-wrapper">
                  <p class="profile-name" style="color:white;text-transform:uppercase;">
                    @if(Auth::guard('admin')->check())
                      {{ Auth::guard('admin')->user()->nm_admin }}
                        @else
                          {{ Auth::user()->nm_user }}
                    @endif
                  </p>
                  <div >
                    <small class="designation text-white">
                      @component('component.who')
                      @endcomponent
                    </small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
            </div>
          </li>
          @yield('sidebar-menu')
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper" style="padding:10px;">
          @yield('content')
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card" style="padding:0px;">
            <div class="card card-statistics social-card card-default">
              <div class="card-header header-sm" style="height:auto;">
                <div class="d-flex align-items-center">
                    <div class="wrapper d-flex align-items-center media-info text-facebook">
                    @yield('manajemen-icon')
                    <h2 class="card-title ml-3">@yield('manajemen-title')</h5>
                    </div>
                    @yield('manajemen-button-tambah')
                </div>
              </div>
              <div class="card-body"  style="padding:10px 15px;">
                @yield('manajemen-table')
              </div>
            </div>
          </div>
          @include('layouts/partials._modal')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer" style="border-top:2px white solid; padding:10px;">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019 <a href="http://lptik.unib.ac.id/en/home"
                target="_blank">LPTIK UNIB</a>.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><a href="https://www.unib.ac.id/" style="color:#858585;"><i class="fa fa-university"></i> UNIVERSITAS BENGKULU</a>
            </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('assets/template/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/template/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('assets/template/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  {{-- Validator --}}
  <script src="{{ asset('assets/validator/validator.min.js') }}"></script>
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('assets/template/js/shared/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/template/js/shared/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/template/js/shared/misc.js') }}"></script>
  <script src="{{ asset('assets/template/js/shared/settings.js') }}"></script>
  <script src="{{ asset('assets/template/js/shared/todolist.js') }}"></script>
  <script src="{{ asset('assets/template/js/shared/dropify.js') }}"></script>
  <script src="{{ asset('assets/template/js/shared/formpickers.js') }}"></script>
  <script src="{{ asset('assets/template/js/shared/file-upload.js') }}"></script>
  <!-- endinject -->
   <!-- Sweetalert2 -->
   <script src="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <!-- Custom js for this page-->
  <script src="{{ asset('assets/template/js/demo_1/dashboard.js') }}"></script>
  <!-- End custom js for this page-->
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

  <script src="{{ asset('js/app.js') }}"></script>
  @include('layouts/partials/file_js')
  @stack('scripts')
</body>

</html>