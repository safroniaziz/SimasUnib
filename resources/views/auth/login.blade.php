<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Simas Unib - Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/iconfonts/puse-icons-feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/css/vendor.bundle.addons.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/template/css/shared/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-utama.png') }}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper" >
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one" style="background:url({{ asset('assets/img/bg-book.png') }})">
          <div class="row w-100" style="margin-left:0px;">
            <div class="col-lg-4 mx-auto">
              <div class="auto-form-wrapper" style="padding:30px 20px;">
                <form method="post">
                @csrf
                  <div class="form-group"> 
                    <h3 style="text-align:center;font-weight:bold;">SISTEM INFORMASI SURAT MENYURAT</h3>
                    <h5 style="text-align:center;">UNIVERSITAS BENGKULU</h5>
                  </div>
                  <div class="form-group">
                    <label class="label">Username</label>
                    <div class="input-group">
                      <input type="text" name="username" class="form-control" placeholder="Username">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-account-check circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="label">Password</label>
                    <div class="input-group">
                      <input type="password" name="password" class="form-control" placeholder="*********">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-account-key"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary submit-btn btn-block">Login</button>
                  </div>
                  <div class="form-group d-flex justify-content-between">
                    <div class="form-check form-check-flat mt-0">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" checked> Simpan data login saya </label>
                    </div>
                    <a href="#" class="text-small forgot-password text-black">Lupa password ?</a>
                  </div>
                  <div class="text-block text-center my-3">
                    <span class="text-small font-weight-semibold">Belum Terdaftar ?</span>
                    <a href="register.html" class="text-black text-small">Buat Akun Baru</a>
                  </div>
                </form>
              </div>
              <p class="footer-text text-center text-white" style="margin-top:10px;">copyright © 2019 <a href="http://lptik.unib.ac.id/en/home" class="text-white">LPTIK UNIB</a>. <a href="https://www.unib.ac.id/" class="text-white">UNIVERSITAS BENGKULU</a>.</p>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/template//vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/template//vendors/js/vendor.bundle.addons.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('assets/template//js/shared/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/template//js/shared/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/template//js/shared/misc.js') }}"></script>
    <script src="{{ asset('assets/template//js/shared/settings.js') }}"></script>
    <script src="{{ asset('assets/template//js/shared/todolist.js') }}"></script>
    <!-- endinject -->
  </body>
</html>