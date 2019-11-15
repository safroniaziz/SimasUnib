@extends('layouts/template')
@section('page-title')
    Admin - Laporan Rekapitulasi
@endsection
@section('user-level')
  Master Admin
@endsection
@section('sidebar-menu')
    @include('admin/sidebar-menu')
@endsection
@section('manajemen-icon')
  <i class="fa fa-bar-chart text-dark"></i>
@endsection
@section('manajemen-title','Manajemen kode Surat')
@section('manajemen-button-tambah')
  <div class="wrapper ml-auto action-bar">
</div>
@endsection
@section('manajemen-table')
  <div class="row">
      <div class="col-md-12" style="margin-bottom:5px;">
          <form action="{{ route('admin.laporan') }}" method="GET">
                <span>Tipe Surat</span>
                <select name="tipe_surat" id="" class="form-control" style="margin-bottom:5px;">
                  <option value="masuk">Surat Masuk</option>
                  <option value="keluar">Surat Keluar</option>
                </select>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Filter Laporan</button>
          </form>
      </div>
      
    <div class="col-12">
      <table id="table-kode-surat" class="table dt-responsive table-hover table-striped table-bordered nowrap " style="width:100%;">
        <thead>
          <tr class="tr-header">
            <td>No</td>
            <td>Satker Pengirim Surat</td>
            <td>Satker Penerimas Surat</td>
            <td>No Surat</td>
            <td>Perihal</td>
            <td>Tujuan</td>

          </tr>
        </thead>
        <tbody>
           <?php 
                $no=1;

              if (isset($_GET['tipe_surat'])) {
                // if($_GET['tipe_surat','masuk']){
                  foreach ($data as $data) {
                    ?>
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->pengirim }}</td>
                        <td>{{ $data->penerima }}</td>
                        <td>{{ $data->no_surat }}</td>
                        <td>{{ $data->perihal }}</td>
                        <td>{{ $data->tujuan }}</td>
                      </tr>
                    <?php
                  }
                // }
              }
            ?>
        </tbody>
      </table>
    </div>
  </div>
@endsection
