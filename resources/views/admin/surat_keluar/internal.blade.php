@extends('layouts/template')
@section('page-title')
    Admin - Surat Keluar
@endsection
@section('sidebar-menu')
    @include('admin/sidebar-menu')
@endsection
@section('manajemen-icon')
  <i class="mdi mdi-email icon-md text-dark"></i>
@endsection
@section('manajemen-title','Data Surat Keluar Internal')
@section('manajemen-button-tambah')
    {{-- <div class="wrapper ml-auto action-bar">
        <a href="{{ route('admin.surat_keluar_internal.create') }}" class="btn btn-primary btn-flat modal-show" title="Tambah Pejabat Disposisi"><i class="fa fa-plus text-white"></i>Tambah Pejabat Disposisi</a>
    </div> --}}
@endsection
@section('manajemen-table')
<div class="row">
    <div class="col-12 table-responsive">
      <table id="admin-table-surat-keluar-internal" class="table dt-responsive table-hover table-striped table-bordered nowrap " style="width:100%;">
        <thead>
          <tr class="tr-header">
          <td>No</td>
          <td>Tipe Surat</td>
          <td>Satker Pengirim Surat</td>
          <td>Penerima Surat</td>
          <td>lampiran</td>
          <td>Jenis Surat</td>
          <td>No Surat</td>
          <td>Perihal</td>
          <td>Tujuan</td>
          <td>Catatan</td>
          <td>Sifat Surat</td>
          <td>Tanggal Surat</td>
          <td>Status</td>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
        $('#admin-table-surat-keluar-internal').DataTable({
          responsive: true,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.surat_keluar_internal.api') }}",
            columns: [
                {data: 'rownum',name:'rownum'},
                {data: 'tipe_surat',name:'tipe_surat'},
                {data: 'nm_pengirim_surat',name:'nm_pengirim_surat'},
                {data: 'nm_penerima_surat',name:'nm_penerima_surat'},
                {data: 'lampiran', 
                        render:function(data, type, row){
                            if(data != null)
                            {
                                return '<style="font-size:11px;">'+data+'</style>';
                            }
                            else
                            {
                                return '<label class="badge badge-danger" style="font-size:11px;">'+'<i class="fa fa-close"></i>'+'&nbsp;data belum diisi'+'</label>';
                            }
                        }
                },
                {data: 'jenis_surat',name:'jenis_surat'},
                {data: 'no_surat',name:'no_surat'},
                {data: 'perihal', 
                        render:function(data, type, row){
                            if(data != null)
                            {
                              return '<style="font-size:11px;">'+data+'</style>';
                            }
                            else
                            {
                                return '<label class="badge badge-danger" style="font-size:11px;">'+'<i class="fa fa-close"></i>'+'&nbsp;data belum diisi'+'</label>';
                            }
                        }
                },
                {data: 'tujuan', 
                        render:function(data, type, row){
                            if(data != null)
                            {
                                return '<style="font-size:11px;">'+data+'</style>';
                            }
                            else
                            {
                                return '<label class="badge badge-danger" style="font-size:11px;">'+'<i class="fa fa-close"></i>'+'&nbsp;data belum diisi'+'</label>';
                            }
                        }
                },
                {data: 'catatan', 
                        render:function(data, type, row){
                            if(data != null)
                            {
                                return '<style="font-size:11px;">'+data+'</style>';
                            }
                            else
                            {
                              return '<label class="badge badge-danger" style="font-size:11px;">'+'<i class="fa fa-close"></i>'+'&nbsp;data belum diisi'+'</label>';
                            }
                        }
                },
                {data: 'sifat_surat',name:'sifat_surat'},
                {data: 'tanggal_surat',name:'tanggal_surat'},
                {data: 'status', 
                        render:function(data, type, row){
                            if(data == 1)
                            {
                              return '<label class="badge badge-success" style="font-size:11px;">'+'<i class="fa fa-check"></i>'+'&nbsp;Sudah dibaca'+'</label>';
                            }
                            else
                            {
                              return '<label class="badge badge-warning" style="font-size:11px;">'+'<i class="fa fa-spinner"></i>'+'&nbsp;Belum dibaca'+'</label>';
                            }
                        }
                },
                
            ],
            
        })
    </script>
@endpush