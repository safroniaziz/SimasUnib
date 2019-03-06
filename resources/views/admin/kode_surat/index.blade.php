@extends('layouts/template')
@section('page-title')
    Admin - Kode Surat
@endsection
@section('user-level')
  Master Admin
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
    <a href="{{ route('admin.kode_surat.create') }}" class="btn btn-primary btn-flat modal-show" title="Tambah Kode Surat"><i class="fa fa-plus text-white"></i>Tambah Kode Surat</a>
  </div>
@endsection
@section('manajemen-table')
  <div class="row">
    <div class="col-12">
      <table id="table-kode-surat" class="table dt-responsive table-hover table-striped table-bordered nowrap " style="width:100%;">
        <thead>
          <tr class="tr-header">
            <td>No</td>
            <td>Kode Surat</td>
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
        $('#table-kode-surat').DataTable({
            responsive: true,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.kode_surat.api') }}",
            columns: [
                {data: 'DT_RowIndex',name:'id'},
                {data: 'kode_surat',name:'kode_surat'},
                {data: 'keterangan',name:'keterangan'},
                {data: 'action',name:'action'},
            ],
            
        })
    </script>
@endpush