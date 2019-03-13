@extends('layouts/template')
@section('page-title')
    Admin - Manajemen User
@endsection
@section('sidebar-menu')
    @include('admin/sidebar-menu')
@endsection
@section('manajemen-icon')
    <i class="mdi mdi-code-tags icon-md text-dark"></i>
@endsection
@section('manajemen-title','Manajemen User')
@section('manajemen-button-tambah')
  <div class="wrapper ml-auto action-bar">
      <a onclick="formTambahUser()" class="btn btn-primary pull-right" style="margin-top:-8px;color:white;"><i class="fa fa-plus"></i>&nbsp;Tambah User</a>
  </div>
@endsection
@section('manajemen-table')
  <div class="row">
    <div class="col-12 table-responsive">
      <table id="table-user" class="table dt-responsive table-hover table-striped table-bordered nowrap " style="width:100%;">
        <thead>
          <tr class="tr-header">
            <td>No</td>
            <td>Satuan Kerja</td>
            <td>Nama User</td>
            <td>Username</td>
            <td>Foto</td>
            <td>Level User</td>
            <td>Terdaftar Sejak</td>
            <td>Aksi</td>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  @include('admin/manajemen_user.form')
@endsection