@extends('layouts/template')
@section('page-title')
    Admin - Manajemen Jabatan
@endsection
@section('sidebar-menu')
    @include('admin/sidebar-menu')
@endsection
@section('manajemen-icon')
  <i class="mdi mdi-code-tags icon-md text-dark"></i>
@endsection
@section('manajemen-title','Manajemen Jabatan')
@section('manajemen-button-tambah')
  <div class="wrapper ml-auto action-bar">
    <a href="{{ route('admin.manajemen_jabatan.create') }}" class="btn btn-primary btn-flat modal-show" title="Tambah Jabatan"><i class="fa fa-plus text-white"></i>Tambah Jabatan</a>
  </div>
@endsection
@section('manajemen-table')
  <div class="row">
    <div class="col-12">
      <table id="table-jabatan" class="table dt-responsive table-hover table-striped table-bordered nowrap " style="width:100%;">
        <thead>
          <tr class="tr-header">
            <td>No</td>
            <td>Nama Jabatan</td>
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
        $('#table-jabatan').DataTable({
            responsive: true,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.manajemen_jabatan.api') }}",
            columns: [
                {data: 'DT_RowIndex',name:'id'},
                {data: 'nm_jabatan',name:'nm_jabatan'},
                {data: 'keterangan',name:'keterangan'},
                {data: 'action',name:'action'},
            ],
            
        })
    </script>
@endpush