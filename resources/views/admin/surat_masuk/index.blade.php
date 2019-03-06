@extends('layouts/template')
@section('page-title')
    Admin - Surat Masuk
@endsection
@section('sidebar-menu')
    @include('admin/sidebar-menu')
@endsection
@section('manajemen-icon')
  <i class="mdi mdi-email icon-md text-dark"></i>
@endsection
@section('manajemen-title','Manajemen Surat Masuk')
@section('manajemen-button-tambah')
  <div class="wrapper ml-auto action-bar">
    <a href="{{ route('admin.surat_masuk.create') }}" class="btn btn-primary btn-flat modal-show" title="Tambah Surat Masuk"><i class="fa fa-plus text-white"></i>Tambah Surat Masuk</a>
  </div>
@endsection
@section('manajemen-table')
  <div class="row">
    <div class="col-12 table-responsive">
      <table id="table-surat-masuk" class="table dt-responsive table-hover table-striped table-bordered nowrap " style="width:100%;">
        <thead>
            <tr class="tr-header">
              <td>No</td>
              <td>Nama Pejabat Disposisi</td>
              <td>NIP</td>
              <td>Jabatan</td>
              <td>Jenis Surat</td>
              <td>No Surat</td>
              <td>Pengirim</td>
              <td>Perihal</td>
              <td>Tujuan</td>
              <td>lampiran</td>
              <td>Catatan</td>
              <td>Sifat Surat</td>
              <td>Status</td>
              <td>Aksi</td>
            </tr>
        </thead>
      </table>
    </div>
  </div>

@endsection