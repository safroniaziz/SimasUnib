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

@push('scripts')
     <script>
        $('#table-surat-masuk').DataTable({
            responsive: true,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.surat_masuk.api') }}",
            columns: [
                {data: 'DT_RowIndex',name:'id'},
                {data: 'nm_pejabat',name:'nm_pejabat'},
                {data: 'nip_pejabat',name:'nip_pejabat'},
                {data: 'nm_jabatan',name:'nm_jabatan'},
                {data: 'jenis_surat',name:'jenis_surat'},
                {data: 'no_surat',name:'no_surat'},
                {data: 'pengirim',name:'pengirim'},
                {data: 'perihal',name:'perihal'},
                {data: 'tujuan',name:'tujuan'},
                {data: 'lampiran',name:'lampiran'},
                {data: 'catatan',name:'catatan'},
                {data: 'sifat_surat',name:'sifat_surat'},
                {data: 'status', 
                        render:function(data, type, row){
                            if(data == 0)
                            {
                              return '<label class="badge badge-danger" style="font-size:12px;">'+'<i class="fa fa-close"></i>'+'&nbsp;Belum Dibaca'+'</label>';
                            }
                            else
                            {
                              return '<label class="badge badge-success" style="font-size:12px;">'+'<i class="fa fa-check"></i>'+'&nbsp;Sudah Dibaca'+'</label>';
                            }
                        }
                },
                {data: 'action',name:'action'},
            ],
            
        })
    </script>
@endpush