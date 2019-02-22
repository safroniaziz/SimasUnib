@extends('layouts/template')
@section('page-title')
    Admin - Dashboard
@endsection
@section('sidebar-menu')
    @include('admin/sidebar-menu')
@endsection
@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card" style="padding:0px;">
        <div class="card card-statistics social-card card-default">
            <div class="card-header header-sm">
            <div class="d-flex align-items-center">
                <div class="wrapper d-flex align-items-center media-info text-facebook">
                    <i class="mdi mdi-code-tags icon-md"></i>
                    <h2 class="card-title ml-3">Manajemen kode Surat</h5>
                </div>
                <div class="wrapper ml-auto action-bar">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal-4" data-whatever="@mdo">Open modal for @mdo</button>
                </div>
            </div>
            
            </div>
            <div class="card-body" style="padding:10px 15px;">
            <div class="row">
                  <div class="col-12">
                    <table id="table-kode-surat" class="table dt-responsive table-striped table-bordered nowrap " style="width:100%;">
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
            </div>
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