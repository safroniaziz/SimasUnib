@extends('layouts/template')
@section('page-title')
    Admin - Manajemen User
@endsection
@section('sidebar-menu')
    @include('admin/sidebar-menu')
@endsection
@section('manajemen-icon')
    <i class="fa fa-users icon-md text-dark"></i>
@endsection
@section('manajemen-title')
<p id="manajemen-title">Manajemen User</p>
@endsection
@section('manajemen-button-tambah')
  <div class="wrapper ml-auto action-bar">
	    <a onclick="tambahUser()" class="btn btn-primary pull-right btn-flat"  style="margin-top: -8px; margin-left: 10px; color:white;" ><i class="fa fa-plus"></i>&nbsp;Tambah User</a>
  </div>
@endsection
@push('styles')
  <style>
    .modal-lg {
    max-width: 100% !important;
}
  </style>
@endpush
@section('manajemen-table')
  <div class="row" id="row-table-user">
    <div class="col-12 table-responsive">
      <table id="table-user" class="table dt-responsive table-hover table-striped table-bordered nowrap " style="width:100%;">
        <thead>
          <tr class="tr-header">
            <td>No</td>
            <td>Nama User</td>
            <td>Foto User</td>
            <td>Username</td>
            <td>Satuan Kerja</td>
            <td>Level User</td>
            <td>Terdaftar Sejak</td>
            <td>Aksi</td>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  @include('admin/manajemen_user.form')
@endsection

@push('scripts')
  <script>
    $('#table-user').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: "{{ route('admin.manajemen_user.api')  }}",
        columns: [
            {data: 'rownum', name: 'rownum'},
            {data: 'nm_user', name:'nm_user'},
            {data: 'foto', name:'foto'},
            {data: 'username', name:'username'},
            {data: 'nm_satuan_kerja', name:'nm_satuan_kerja'},
            {data: 'level', name:'level'},
            {data: 'created_at', name:'created_at'},
            {data: 'action', name:'action', orderable: false, searchable: false,}
        ]
    });

  function tambahUser(){
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('#form-user').modal('show');
    $('.modal-dialog').css('width','750px');
    $('#form-user form')[0].reset();
    $('.modal-title').text('TAMBAH USER BARU');
    $('#password-form').show();
}

function editUser(id){
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#form-user form')[0].reset();
    $.ajax({
      url: "{{ url('admin/manajemen_user') }}"+'/'+ id + "/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('#form-user').modal('show');
        $('.modal-title').text('EDIT USER '+'('+data.nm_user+')');
        $('.modal-dialog').css('width','750px');
        $('#modal-title').text('Edit User');
        $('#id').val(data.id);
        $('#id_satuan_kerja').val(data.id_satuan_kerja).trigger('change');
        $('#nm_user').val(data.nm_user);
        $('#username').val(data.username);
        $('#level').val(data.level).trigger('change');
        $('#password-form').remove();
        $('#upload-value').val(data.foto);
        $('#foto-baru').val(data.foto);
      },
      error:function(){
        alert("Nothing Data");
      }
    });
  }

  function previewFoto() {
    var preview = document.querySelector('#preview-foto');
    var file    = document.querySelector('input[type=file]').files[0];
    var reader  = new FileReader();

    reader.onloadend = function () {
      preview.src = reader.result;
    }

    if (file) {
      reader.readAsDataURL(file);
    } else {
      preview.src = "";
    }
  }

  

function hapusUser(id){
  var csrf_token = $('meta[name="csrf-token"]').attr('content');
  swal({
        title: 'Apakah anda yakin ingin menghapus data  ?',
        text: 'Anda tidak dapat mengembalikan data jika dihapus!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus data!'
  }).then(function () {
      $.ajax({
          url : "{{ url('admin/manajemen_user') }}" + '/' + id,
          type : "POST",
          data : {'_method' : 'DELETE', '_token' : csrf_token},
          success : function(data) {
            $('#table-user').dataTable().api().ajax.reload();
              swal({
                  title: 'Berhasil!',
                  text: 'Data sudah menjadi sampah!',
                  type: 'success',
                  timer: '1500'
              })
          },
          error : function () {
              swal({
                  title: 'Oops...',
                  text: ' Terjadi Kesalahan!',
                  type: 'error',
                  timer: '1500'
              })
          }
      });
  });
}

$(function(){
    $('#form-user form').validator().on('submit', function(e){
      if (!e.isDefaultPrevented()) {
        var id = $('#id').val();
        if (save_method == 'add') url = "{{ url('admin/manajemen_user') }}";
        else url = "{{ url('admin/manajemen_user').'/' }}"+id;

        $.ajax({
          url : url,
          type : "POST",
          // data : $('#form-user form').serialize(),
          data : new FormData($('#form-user form')[0]),
          contentType : false,
          processData : false,
          success : function($data){
            $('#form-user').modal('hide');
            $('#table-user').dataTable().api().ajax.reload();
            swal({
              title:'Berhasil!',
              text:'Data Sudah Diperbarui',
              type:'success',
              timer:'1500'
            })
          }
        });
        return false;
      }
    });
  });

    $( "#id_satuan_kerja" ).select2({
        theme: "bootstrap",
        width: "100%",
        dropdownParent: $('#form-user'),
    });

    $( "#level" ).select2({
        theme: "bootstrap",
        width: "100%",
        dropdownParent: $('#form-user'),
    });

    
  </script>
@endpush