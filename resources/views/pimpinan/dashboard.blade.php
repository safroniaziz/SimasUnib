@extends('layouts/template')
@section('page-title')
    Pimpinan - Dashboard
@endsection
@section('sidebar-menu')
    @include('pimpinan/sidebar-menu')
@endsection
@section('content')
  @if (\Session::has('gagal-admin'))
  <div class="alert alert-danger">
          <i class="fa fa-close"></i> {!! \Session::get('gagal-admin') !!} !!
  </div>
  @elseif(\Session::has('gagal-staf-tu'))
    <div class="alert alert-danger">
            <i class="fa fa-close"></i> {!! \Session::get('gagal-staf-tu') !!} !!
    </div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-fill-primary col-" role="alert">
        <i class="mdi mdi-alert-circle"></i> Selamat Datang <a style="text-transform:uppercase;">{{Auth::user()->nm_user}}</a>, Jangan Lupa Logout Setelah Menggunakan Aplikasi
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="mdi mdi-cube text-danger icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right" style="text-transform:uppercase;">Surat Masuk</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0"></h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>  Surat Belum Dibaca </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="mdi mdi-receipt text-warning icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right" style="text-transform:uppercase;">Surat Keluar</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0">3455</h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Product-wise sales </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="mdi mdi-poll-box text-success icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right" style="text-transform:uppercase;">User</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0"></h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Weekly Sales </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="mdi mdi-account-box-multiple text-info icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right" style="text-transform:uppercase;">Satuan Kerja</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0"></h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Product-wise sales </p>
        </div>
      </div>
    </div>
  </div>
@endsection