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
        <a onclick="tambahPejabatDisposisi()" class="btn btn-primary pull-right btn-flat"  style="margin-top: -8px; margin-left: 10px; color:white;" ><i class="fa fa-plus"></i>&nbsp;Tambah Pejabat Disposisi</a>
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
                <td>Aksi</td>
            </tr>
            </thead>
        </table>
        </div>
    </div>
    @include('admin/pejabat_disposisi.form')
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
                {data: 'action',name:'action'},
            ],
        });

        function tambahPejabatDisposisi(){
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#form-pejabat-disposisi').modal('show');
            $('.modal-dialog').css('width','750px');
            $('#form-pejabat-disposisi form')[0].reset();
            $('.modal-title').text('TAMBAH USER BARU');
            $('#password-form').show();
        }

        function editUser(id){
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#form-pejabat-disposisi form')[0].reset();
            $.ajax({
            url: "{{ url('admin/manajemen_user') }}"+'/'+ id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#form-pejabat-disposisi').modal('show');
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
            $('#form-pejabat-disposisi form').validator().on('submit', function(e){
            if (!e.isDefaultPrevented()) {
                var id = $('#id').val();
                if (save_method == 'add') url = "{{ url('admin/manajemen_user') }}";
                else url = "{{ url('admin/manajemen_user').'/' }}"+id;

                $.ajax({
                url : url,
                type : "POST",
                // data : $('#form-pejabat-disposisi form').serialize(),
                data : new FormData($('#form-pejabat-disposisi form')[0]),
                contentType : false,
                processData : false,
                success : function($data){
                    $('#form-pejabat-disposisi').modal('hide');
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
            dropdownParent: $('#form-pejabat-disposisi'),
        });

        $( "#level" ).select2({
            theme: "bootstrap",
            width: "100%",
        });

    
    </script>
@endpush