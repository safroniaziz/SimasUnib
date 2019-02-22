@extends('layouts/template')
@section('page-title')
    Admin - Surat Keluar
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
                    <i class="mdi mdi-share-variant mr-3"></i>
                    <i class="mdi mdi-heart"></i>
                </div>
            </div>
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
@endsection