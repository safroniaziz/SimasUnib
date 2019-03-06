@extends('layouts/template')
@section('page-title')
    Admin - Pejabat Disposisi
@endsection
@section('sidebar-menu')
    @include('admin/sidebar-menu')
@endsection
@section('manajemen-icon')
    <i class="mdi mdi-account-box-outline icon-md text-dark"></i>
@endsection
@section('manajemen-title','Manajemen Pejabat Disposisi')
@section('manajemen-button-tambah')
    <div class="wrapper ml-auto action-bar">
        <a href="{{ route('admin.pejabat_disposisi.create') }}" class="btn btn-primary btn-flat modal-show" title="Tambah Pejabat Disposisi"><i class="fa fa-plus text-white"></i>Tambah Pejabat Disposisi</a>
    </div>
@endsection
@section('manajemen-table')
    <div class="row">
        <div class="col-12">
        <table id="table-pejabat-disposisi" class="table dt-responsive table-hover table-striped table-bordered nowrap " style="width:100%;">
            <thead>
            <tr class="tr-header">
                <td>No</td>
                <td>Nama Satuan Kerja</td>
                <td>Nama Pejabat</td>
                <td>Nip Pejabat</td>
                <td>Jabatan</td>
                <td>Telephone</td>
                <td>Email</td>
                <td>Level Disposisi</td>
                <td>Aksi</td>
            </tr>
            </thead>
        </table>
        </div>
    </div>
@endsection

@push('scripts')
     <script>
        $('#table-pejabat-disposisi').DataTable({
            responsive: true,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.pejabat_disposisi.api') }}",
            columns: [
                {data: 'DT_RowIndex',name:'id'},
                {data: 'nm_satuan_kerja',name:'nm_satuan_kerja'},
                {data: 'nm_pejabat',name:'nm_pejabat'},
                {data: 'nip_pejabat',name:'nip_pejabat'},
                {data: 'nm_jabatan',name:'nm_jabatan'},
                {data: 'no_telephone',name:'no_telephone'},
                {data: 'email',name:'email'},
                {data: 'level_disposisi',name:'level_disposisi'},
                {data: 'action',name:'action'},
            ],
        })
    </script>
@endpush