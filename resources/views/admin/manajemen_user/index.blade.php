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
@push('styles')
  <style>
    #btn-hide-form-user{
      display: none;
    }

    #idUser{
      display: none;
    }
  </style>
@endpush
@section('manajemen-button-tambah')
  <div class="wrapper ml-auto action-bar">
      <button type="button" name="btn-tampilkan-form-user" id="btn-tampilkan-form-user" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Tambah User</button>
      <button type="button" name="btn-hide-form-user" id="btn-hide-form-user" class="btn btn-danger"><i class="fa fa-minus"></i>&nbsp;Batalkan</button>
  </div>
@endsection
@section('manajemen-table')
  <form method="POST" class="form-horizontal" data-toggle="validator">
    {{Form::token()}}
    @include('admin/manajemen_user.form')
  </form>
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
@endsection

@push('scripts')
  <script>
    $('#btn-tampilkan-form-user').click(function(){
        $('#btn-tampilkan-form-user').hide()
        $('#btn-hide-form-user').show();
        $('.form-user').show(500);
    });

    $('#btn-hide-form-user').click(function(){
      $('#btn-hide-form-user').hide();
      $('#btn-tampilkan-form-user').show();
      $('.form-user').hide(500);
    });

  </script>
@endpush