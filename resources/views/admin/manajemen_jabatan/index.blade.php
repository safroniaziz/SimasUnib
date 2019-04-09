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
    <a href="{{ route('admin.manajemen_jabatan.create') }}" class="btn btn-primary btn-flat modal-show" title="Tambah User"><i class="fa fa-plus text-white"></i>Tambah User</a>
  </div>
@endsection
@section('manajemen-table')
  <div class="row">
    <div class="col-12">
      <table id="table-jabatan" class="table dt-responsive table-hover table-striped table-bordered nowrap " style="width:100%;">
        <thead>
          <tr class="tr-header">
            <td>No</td>
            <td>Nama Satuan Kerja</td>
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
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.manajemen_jabatan.api') }}",
            columns: [
                {data: 'DT_RowIndex',name:'id'},
                {data: 'nm_satuan_kerja',name:'nm_satuan_kerja'},
                {data: 'nm_jabatan',name:'nm_jabatan'},
                {data: 'keterangan', 
                        render:function(data, type, row){
                            if(data == null)
                            {
                              return '<label class="badge badge-danger" style="font-size:11px;">'+"tidak ada keterangan"+'</label>';
                            }
                            else
                            {
                              return '<style="font-size:11px;">'+data;
                            }
                        }
                },
                {data: 'action',name:'action'},
            ],
            
        })
    </script>
@endpush