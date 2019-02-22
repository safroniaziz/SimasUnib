@extends('layouts/template')
@section('page-title')
    Admin - Dashboard
@endsection
@section('sidebar-menu')
    @include('admin/sidebar-menu')
@endsection
@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card bg-primary">
        <div class="card-body py-3">
          <div class="d-flex flex-row  align-items">
            <i class="mdi mdi-television text-white icon-lg"></i>
            <div class="ml-3">
              <h6 class="text-white font-weight-semibold mb-0">DASHBOARD</h6>
              <p class="text-white card-text">Selamat Datang {{ Auth::user()->nm_admin }}, anda berhasil login sebagai <b class="text-white">ADMINISTRATOR</b>. Jangan lupa <b class="text-danger">LOGOUT</b> setelah menggunakan aplikasi !</p>
            </div>
          </div>
        </div>
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
              <p class="mb-0 text-right">Total Revenue</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0">$65,650</h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> 65% lower growth </p>
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
              <p class="mb-0 text-right">Orders</p>
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
              <p class="mb-0 text-right">Sales</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0">5693</h3>
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
              <p class="mb-0 text-right">Employees</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0">246</h3>
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