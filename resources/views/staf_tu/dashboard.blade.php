@extends('layouts/template')
@section('page-title')
    Staf TU -Dashboard
@endsection
@section('sidebar-menu')
    @include('staf_tu/sidebar-menu')
@endsection
@section('content')
      @if (\Session::has('gagal-admin'))
        <div class="card-body">
              <div class="alert alert-danger">
                      <i class="fa fa-close"></i> {!! \Session::get('gagal-admin') !!} !!
              </div>
              @elseif(\Session::has('gagal-pimpinan'))
                <div class="alert alert-danger">
                        <i class="fa fa-close"></i> {!! \Session::get('gagal-pimpinan') !!} !!
                </div>
        </div>
          @endif
          <!-- row selamat datang -->
          <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card bg-primary">
        <div class="card-body py-3">
          <div class="d-flex flex-row  align-items">
            <i class="mdi mdi-television text-white icon-lg"></i>
            <div class="ml-3">
              <h6 class="text-white font-weight-semibold mb-0">DASHBOARD</h6>
              <p class="text-white card-text">Selamat Datang {{ Auth::user()->nm_admin }}, anda berhasil login sebagai <b class="text-white">ADMINISTRATOR</b>. Silahkan gunakan menu yang telah disediakan, dan angan lupa <b class="text-danger">LOGOUT</b> setelah menggunakan aplikasi !</p>
            </div>
          </div>
        </div>
          <!-- end row selamat datang -->
          
          <!-- row widgets -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Bookmarks</span>
                  <span class="info-box-number">41,410</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                      <span class="progress-description">
                        70% Increase in 30 Days
                      </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Likes</span>
                  <span class="info-box-number">41,410</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                      <span class="progress-description">
                        70% Increase in 30 Days
                      </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Events</span>
                  <span class="info-box-number">41,410</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                      <span class="progress-description">
                        70% Increase in 30 Days
                      </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Comments</span>
                  <span class="info-box-number">41,410</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                      <span class="progress-description">
                        70% Increase in 30 Days
                      </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- end row widgets -->
        </div>
        <!-- /.box-body -->
@endsection