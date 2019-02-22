@extends('layouts/template')
@section('page-title')
    Pimpinan - Dashboard
@endsection
@section('sidebar-menu')
    @include('pimpinan/sidebar-menu')
@endsection
@section('content')
<div class="row">
          <div class="col-md-12">
            <div class="box-header with-border" style="padding:7px 7px 3px 10px;">
              <h3 class="box-title"><b><i class="fa fa-television"></i> DASHBOARD </b></h3>
                
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="box-body">
        <!-- Jika redirect secara langsung ke admin -->
        @if (\Session::has('gagal-admin'))
            <div class="alert alert-danger">
                    <i class="fa fa-close"></i> {!! \Session::get('gagal-admin') !!} !!
            </div>
            @elseif(\Session::has('gagal-staf-tu'))
              <div class="alert alert-danger">
                      <i class="fa fa-close"></i> {!! \Session::get('gagal-staf-tu') !!} !!
              </div>
        @endif
          <!-- row selamat datang -->
          <div class="row">
            <div class="col-md-12">
              <div class="callout callout-info">
                <h4 style="margin-bottom:3px;">Selamat Datang !</h4>
                <p>Anda berhasil login sebagai <b> PIMPINAN</b>, silahkan gunakan menu yang telah disediakan, dan jangan lupa <b>Logout</b> setelah menggunakan aplikasi !</p>
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