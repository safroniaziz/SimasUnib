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
    <a onclick="tambahJabatan()" class="btn btn-primary pull-right btn-flat"  style="margin-top: -8px; margin-left: 10px; color:white;" ><i class="fa fa-plus"></i>&nbsp;Tambah Jabatan</a>
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
            <td>Nama Satuan Kerja Singkat</td>
            <td>Nama Jabatan</td>
            <td>Keterangan</td>
            <td>Aksi</td>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  @include('admin/manajemen_jabatan.form');
@endsection

@push('scripts')
     <script>
        $('#table-jabatan').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.manajemen_jabatan.api') }}",
            columns: [
                {data: 'rownum', name: 'rownum'},
                {data: 'nm_satuan_kerja',name:'nm_satuan_kerja'},
                {data: 'nm_satuan_kerja_singkat',name:'nm_satuan_kerja_singkat'},
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

        function tambahJabatan(){
          save_method = "add";
          $('input[name=_method]').val('POST');
          $('#form-jabatan').modal('show');
          $('#form-jabatan form')[0].reset();
          $('.modal-title').text('TAMBAH JABATAN BARU');
          $('#password-form').show();
          $('#jabatan_edit').hide();
        }

        function editJabatan(id){
          save_method = 'edit';
          $('input[name=_method]').val('PATCH');
          $('#form-jabatan form')[0].reset();
          $.ajax({
            url: "{{ url('admin/manajemen_jabatan') }}"+'/'+ id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data){
              $('#form-jabatan').modal('show');
              $('.modal-dialog').css('width','750px');
              $('#modal-title').text('Edit Jabatan');
              $('#id').val(data[0].id_jabatan);
              $('#id_satuan_kerja').val(data[0].id_satuan_kerja);
              $('#nm_jabatan').val(data[0].nm_jabatan);
              $('#keterangan').val(data[0].keterangan);
            },
            error:function(){
              alert("Nothing Data");
            }
          });
        }

        function hapusJabatan(id){
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
                  url : "{{ url('admin/manajemen_jabatan') }}" + '/' + id,
                  type : "POST",
                  data : {'_method' : 'DELETE', '_token' : csrf_token},
                  success : function(data) {
                    $('#table-jabatan').dataTable().api().ajax.reload();
                    
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
        $('#form-jabatan form').validator().on('submit', function(e){
          if (!e.isDefaultPrevented()) {
            var id = $('#id').val();
            if (save_method == 'add') url = "{{ url('admin/manajemen_jabatan') }}";
            else url = "{{ url('admin/manajemen_jabatan').'/' }}"+id;

            $.ajax({
              url : url,
              type : "POST",
              // data : $('#form-jabatan form').serialize(),
              data : new FormData($('#form-jabatan form')[0]),
              contentType : false,
              processData : false,
              success : function($data){
                $('#form-jabatan').modal('hide');
                $('#table-jabatan').dataTable().api().ajax.reload();
                
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
        $(document).ready(function(){
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $("#nm_jabatan,#id_satuan_kerja").keyup(function(){
            var id_satuan_kerja = $("#id_satuan_kerja").val();
            var nm_jabatan = $("#nm_jabatan").val();
            // alert(nm_jabatan);
            // alert(nm_jabatan);
            url = "{{ url('admin/manajemen_jabatan/cari_nama_jabatan') }}";
            $.ajax({
              url :url,
              data : {nm_jabatan:nm_jabatan,id_satuan_kerja:id_satuan_kerja},
              method :"POST",
              success:function(data){
                if(data ==0){
                  $('#mencari_nm_jabatan').show();
                  $('#nm_jabatan_tersedia').hide();
                }
                else if(data == 1){
                  $('#mencari_nm_jabatan').hide();
                  $('#nm_jabatan_tersedia').show();
                }
              }
            })

          })
        })
        
    </script>
@endpush