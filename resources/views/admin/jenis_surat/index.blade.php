@extends('layouts/template')
@section('page-title')
    Admin - Jenis Surat
@endsection
@section('sidebar-menu')
    @include('admin/sidebar-menu')
@endsection
@section('manajemen-icon')
  <i class="mdi mdi-information-outline icon-md text-dark"></i>
@endsection
@section('manajemen-title','Manajemen Jenis Surat')
@section('manajemen-button-tambah')
  <div class="wrapper ml-auto action-bar">
    <a href="{{ route('admin.jenis_surat.create') }}" class="btn btn-primary btn-flat modal-show" title="Tambah Kode Surat"><i class="fa fa-plus text-white"></i>Tambah Jenis Surat</a>
  </div>
@endsection
@section('manajemen-table')
  <div class="row">
    <div class="col-12">
      <table id="table-jenis-surat" class="table dt-responsive table-hover table-striped table-bordered nowrap " style="width:100%;">
        <thead>
          <tr class="tr-header">
            <td>No</td>
            <td>Jenis Surat</td>
            <td>Keterangan</td>
            <td>Aksi</td>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection

@push('scripts')
     <script>
        $('#table-jenis-surat').DataTable({
            responsive: true,
            processing: true,
            
            serverside: true,
            ajax: "{{ route('admin.jenis_surat.api') }}",
            columns: [
                {data: 'DT_RowIndex',name:'id'},
                {data: 'jenis_surat',name:'jenis_surat'},
                {data: 'keterangan',name:'keterangan'},
                {data: 'action',name:'action'},
            ],
            
        })
    </script>
@endpush