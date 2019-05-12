@extends('layouts/template')
@section('page-title')
    Admin - Dashboard
@endsection
@section('sidebar-menu')
    @include('admin/sidebar-menu')
@endsection
@push('styles')
  <style>
    .grid-margin{
      margin-bottom: 15px !important;
    }

    .alert{
      margin-bottom: 15px !important;
    }
  </style>
@endpush
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-fill-primary col-" role="alert">
        <i class="mdi mdi-alert-circle"></i> Selamat Datang <a style="text-transform:uppercase;">{{Auth::user()->nm_admin}}</a>, Jangan Lupa Logout Setelah Menggunakan Aplikasi
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="fa fa-sign-in text-danger icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right" style="text-transform:uppercase;">Surat Masuk</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0">{{ $jumlah_surat_masuk }}</h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="fa fa-sign-in text-primary mr-1" aria-hidden="true"></i> {{ $jumlah_surat_masuk_internal }} Surat Internal </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="fa fa-sign-out text-warning icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right" style="text-transform:uppercase;">Surat Keluar</p>
              <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{ $jumlah_surat_keluar }}</h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="fa fa-sign-out text-primary mr-1" aria-hidden="true"></i>{{ $jumlah_surat_keluar_internal }} Surat Internal</p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="fa fa-users text-success icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right" style="text-transform:uppercase;">User</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0">{{ $jumlah_user }}</h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="fa fa-users text-primary mr-1" aria-hidden="true"></i>{{ $jumlah_user_aktif }} User Aktif </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="fa fa-university text-info icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right" style="text-transform:uppercase;">Satuan Kerja</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0">{{ $jumlah_satuan_kerja }}</h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="fa fa-university text-primary mr-1" aria-hidden="true"></i> Satuan Kerja UNIB </p>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('manajemen-icon')
<i class="fa fa-bar-chart icon-md text-dark"></i>
@endsection

@section('manajemen-title','Statistik Surat Masuk dan Surat Keluar')

@section('manajemen-table')

@endsection
