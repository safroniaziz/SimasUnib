@extends('layouts/template')
@section('page-title')
    Admin - Surat Keluar
@endsection
@section('sidebar-menu')
    @include('admin/sidebar-menu')
@endsection
@section('manajemen-icon')
    <i class="mdi mdi-code-tags icon-md"></i>
@endsection
@section('manajemen-title','Manajemen kode Surat')
@section('manajemen-button-tambah')
    <div class="wrapper ml-auto action-bar">
        <a href="{{ route('admin.pejabat_disposisi.create') }}" class="btn btn-primary btn-flat modal-show" title="Tambah Pejabat Disposisi"><i class="fa fa-plus text-white"></i>Tambah Pejabat Disposisi</a>
    </div>
@endsection
@section('manajemen-table')
    
@endsection