@extends('layouts/template')
@section('page-title')
    Admin - Satuan Kerja
@endsection
@section('sidebar-menu')
    @include('admin/sidebar-menu')
@endsection
@section('manajemen-icon')
  <i class="mdi mdi-account-multiple icon-md text-dark"></i>
@endsection
@section('manajemen-title','Manajemen Satuan Kerja')
@section('manajemen-button-tambah')
  <div class="wrapper ml-auto action-bar">
    <a href="{{ route('admin.satuan_kerja.create') }}" class="btn btn-primary btn-flat modal-show" title="Tambah Satuan Kerja"><i class="fa fa-plus text-white"></i>Tambah Satuan Kerja</a>
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
            <td>Nama Satuan Kerja Singkat</td>
            <td>Telephone</td>
            <td>Website</td>
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
            responsive: true,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.satuan_kerja.api') }}",
            columns: [
                {data: 'DT_RowIndex',name:'id'},
                {data: 'nm_satuan_kerja',name:'nm_satuan_kerja'},
                {data: 'nm_satuan_kerja_singkat',name:'nm_satuan_kerja_singkat'},
                {data: 'no_hp', 
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
                {data: 'website', 
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
            
        })
    </script>
@endpush