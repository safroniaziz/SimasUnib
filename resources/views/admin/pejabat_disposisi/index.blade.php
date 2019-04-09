@extends('layouts/template')
@section('page-title')
    Admin - Pejabat Disposisi
@endsection
@section('sidebar-menu')
    @include('admin/sidebar-menu')
@endsection
@section('manajemen-icon')
  <i class="mdi mdi-account-multiple icon-md text-dark"></i>
@endsection
@section('manajemen-title','Manajemen Pejabat Disposisi')
@section('manajemen-button-tambah')
  <div class="wrapper ml-auto action-bar">
    <a href="{{ route('admin.pejabat_disposisi.create') }}" class="btn btn-primary btn-flat modal-show" title="Tambah Pejabat Disposisi"><i class="fa fa-plus text-white"></i>Tambah Satuan Kerja</a>
  </div>
@endsection
@section('manajemen-table')
  <div class="row">
    <div class="col-12 table-responsive">
      <table id="table-satuan-kerja" class="table dt-responsive table-hover table-striped table-bordered nowrap " style="width:100%;">
        <thead>
          <tr class="tr-header">
            <td>No</td>
            <td>Nama Satuan Kerja</td>
            <td>Nama Pejabat</td>
            <td>Jabatan</td>
            <td>Disposisi / Bawahan</td>
            <td>Email</td>
            <td>Telephone</td>
            <td>Aksi</td>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection

@push('scripts')
     <script>
        $('#table-satuan-kerja').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.pejabat_disposisi.api') }}",
            columns: [
                {data: 'DT_RowIndex',name:'id'},
                {data: 'nm_satuan_kerja',name:'nm_satuan_kerja'},
                {data: 'nm_pejabat',name:'nm_pejabat'},
                {data: 'nm_jabatan',name:'nm_jabatan'},
                {data: 'nm_pejabat_disposisi',name:'nm_pejabat_disposisi'},
                {data: 'email', 
                        render:function(data, type, row){
                            if(data == null)
                            {
                              return '<label class="badge badge-danger" style="font-size:12px;">'+'<i class="fa fa-close"></i>'+'&nbsp;data belum ada'+'</label>';
                            }
                            else
                            {
                              return '<label class="label label-primary" style="font-size:12px;">'+data+'</label>';
                            }
                        }
                },

                {data: 'telephone', 
                        render:function(data, type, row){
                            if(data == null)
                            {
                              return '<label class="badge badge-danger" style="font-size:12px;">'+'<i class="fa fa-close"></i>'+'&nbsp;data belum ada'+'</label>';
                            }
                            else
                            {
                              return '<label class="label label-primary" style="font-size:12px;">'+data+'</label>';
                            }
                        }
                },
                {data: 'action',name:'action'},
            ],
            
        });
    </script>
@endpush