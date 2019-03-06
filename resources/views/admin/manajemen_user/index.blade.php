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
@section('manajemen-title','Manajemen kode Surat')
@section('manajemen-button-tambah')
  <div class="wrapper ml-auto action-bar">
    <a href="{{ route('admin.manajemen_jabatan.create') }}" class="btn btn-primary btn-flat modal-show" title="Tambah Jabatan"><i class="fa fa-plus text-white"></i>Tambah Jabatan</a>
  </div>
@endsection
@section('manajemen-table')
@endsection