@extends('layouts/template')
@section('page-title')
    Staf TU - Surat Keluar
@endsection
@section('sidebar-menu')
    @include('staf_tu/sidebar-menu')
@endsection
@section('manajemen-icon')
  <i class="mdi mdi-email icon-md text-dark"></i>
@endsection
@section('manajemen-title','Manajemen Surat Keluar')
@section('manajemen-button-tambah')
  <div class="wrapper ml-auto action-bar">
    <a onclick="tambahSuratKeluar()" style="color:white;" class="btn btn-primary btn-flat" title="Tambah Surat Masuk"><i class="fa fa-plus text-white"></i>Tambah Surat Keluar</a>
  </div>
@endsection
@push('styles')
    <style>
        fieldset.scheduler-border {
            border: 1px groove #eee !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
        }

        legend.scheduler-border {
            font-size: 1.2em !important;
            font-weight: bold !important;
            text-align: left !important;
            width:auto;
            border-bottom:none;
        }

        fieldset.scheduler-border{
            padding:2px 15px !important; 
        }

        .foto-surat{
            height:200px;
            width:150px;
        }

        .class{
            height: 100px;
        }
    </style>
@endpush
@section('manajemen-table')
@include('staf_tu/surat_keluar.form_internal')
    @if (\Session::has('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Pemberitahuan :</strong> {!! \Session::get('success') !!}
        </div>
    @endif

    <div class="row">
        <div class="col-12 table-responsive">
            <table id="table-surat-keluar-internal" class="table dt-responsive table-hover table-striped table-bordered nowrap " style="width:100%;">
                <thead>
                    <tr class="tr-header">
                        <td>No</td>
                        <td>Tipe Surat</td>
                        <td>Satker Pengirim Surat</td>
                        <td>Satker Penerima Surat</td>
                        <td>Jenis Surat</td>
                        <td>No Surat</td>
                        <td>Perihal</td>
                        <td>Tujuan</td>
                        <td>lampiran</td>
                        <td>Catatan</td>
                        <td>Sifat Surat</td>
                        <td>Tanggal Surat</td>
                        <td>Status</td>
                        <td>Status Teruskan</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#table-surat-keluar-internal').DataTable({
            responsive: true,
            processing: true,
            serverside: true,
            ajax: "{{ route('staf_tu.surat_keluar_internal.api') }}",
            columns: [
                {data: 'rownum',name:'rownum'},
                {data: 'tipe_surat',name:'tipe_surat'},
                {data: 'satker_pengirim_surat',name:'satker_pengirim_surat'},
                {data: 'satker_penerima_surat',name:'satker_penerima_surat'},
                
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
                {data: 'lampiran', name:'lampiran'},
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

                {data: 'status_teruskan', 
                        render:function(data, type, row){
                            if(data == 1)
                            {
                            return '<label class="badge badge-success" style="font-size:11px;">'+'<i class="fa fa-check"></i>'+'&nbsp;Sudah diteruskan'+'</label>';
                            }
                            else
                            {
                            return '<label class="badge badge-warning" style="font-size:11px;">'+'<i class="fa fa-spinner"></i>'+'&nbsp;Menunggu'+'</label>';
                            }
                        }
                },
                {data: 'action',name:'action'},
                
            ],
            // "createdRow": function ( row, data, index ) {
            //     if(data['status_teruskan'] == 0 ) {
            //         $('td', row).css('background-color', '#f2dede' );
            //     }
            // },
        })

        // $(function() {
        //     $('#sifat_surat').on('change', function() {
        //         var sifat_surat = $('#sifat_surat option:selected[value="0"]');
        //         $("#submit").attr("disabled", sifat_surat.val() == 0);
        //     }).change();
        // });

        function tambahSuratKeluar(){
            save_method = 'add';
            $('input[name=_method]').val('POST');
            $("#form-surat-keluar-staf-tu").show(300);
            $("#form-add-edit").show();
            $("#form-teruskan").hide();
            $("#detail-teruskan").hide();
            $('#id').val("");
            $('#id_satker_pengirim_surat').val(0);
            $('#tipe_surat').val("");
            $('#id_jenis_surat').val(0);
            $('#sifat_surat').val(0);
            $('#no_surat').val("");
            $('#perihal').val("");
            $('#tujuan').val("");
            $('#catatan').val("");
            $('#lampiran').val("");
            $('#upload-value').val("");
            $('.foto-surat').removeAttr('src');
            $('.foto-surat').css("border","3px #DC3545 solid");
            $('#peringatan').show();
        }

        function editSuratKeluarInternal(id){
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $.ajax({
                url: "{{ url('staf_tu/surat_keluar_internal') }}"+'/'+ id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $("#form-surat-keluar-staf-tu").show(300);
                    $("#form-add-edit").show();
                    $("#form-teruskan").hide();
                    $("#detail-teruskan").hide();
                    $(window).scrollTop(0);
                    $('#id').val(data.id);
                    $('#tipe_surat').val(data.tipe_surat);
                    // $('#form-teruskan').show();
                    $('#id_satker_pengirim_surat').val(data.id_satker_pengirim_surat);
                    $('#id_jenis_surat').val(data.id_jenis_surat);
                    $('#id_pimpinan_penerima_surat').val(data.id_pimpinan_penerima_surat);
                    $('#sifat_surat').val(data.sifat_surat);
                    $('#no_surat').val(data.no_surat);
                    $('#perihal').val(data.perihal);
                    $('#tujuan').val(data.tujuan);
                    $('#catatan').val(data.catatan);
                    $('#tanggal_surat').val(data.tanggal_surat);
                    $('#upload-value').val(data.lampiran);
                    $('.foto-surat').attr("src",data.lampiran);
                    $('.foto-surat').css("border","3px #17A2B8 solid");
                    $('#peringatan').hide();
                },
                error:function(){
                    alert("Nothing Data");
                }
            });
        }

        function hapusSuratKeluarInternal(id){
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
                    url : "{{ url('staf_tu/surat_keluar_internal') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        $('#table-surat-keluar-internal').dataTable().api().ajax.reload();
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
            
            $('#form-surat-keluar-staf-tu form').validator().on('submit', function(e){
                $.ajaxSetup({
    headers: {
        'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('staf_tu/surat_keluar_internal') }}";
                    else if(save_method == 'edit')url = "{{ url('staf_tu/surat_keluar_internal').'/' }}"+id;

                    $.ajax({
                    url : url,
                    type : "POST",
                    // data : $('#form-surat-keluar-staf-tu form').serialize(),
                    data : new FormData($('#form-surat-keluar-staf-tu form')[0]),
                    contentType : false,
                    processData : false,
                    success : function(data){
                        $('#form-surat-keluar-staf-tu').hide();
                        $('#table-surat-keluar-internal').dataTable().api().ajax.reload();
                        if(save_method == 'teruskan') swal({
                            title:'Berhasil!',
                            text:'Surat Sudah Diteruskan',
                            type:'success',
                            timer:'1500'
                        })
                        else
                            swal({
                                title:'Berhasil!',
                                text:'Data Surat Sudah Diperbarui',
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
            $("#no_surat").keyup(function(){
            var no_surat = $("#no_surat").val();
            // alert(no_surat);
            url = "{{ url('staf_tu/surat_keluar_internal/cari_no_surat') }}";
            $.ajax({
                url :url,
                data : {no_surat:no_surat},
                method :"POST",
                success:function(data){
                if(data ==0){
                    $('#no_surat_tersedia').hide();
                }
                else if(data == 1){
                    $('#no_surat_tersedia').show();
                }
                }
            })

            })
        })

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

        // $(function(){

        //     $('#form-teruskan-internal form').validator().on('submit', function(e){
                
        //         if (!e.isDefaultPrevented()) {
        //             var id = $('#id').val();
        //             if (save_method == 'teruskan') url = "{{ url('staf_tu/surat_keluar_internal').'/' }}"+id;
        //             $.ajax({
        //             url : url,
        //             type : "POST",
        //             // data : $('#form-teruskan-internal form').serialize(),
        //             data : new FormData($('#form-teruskan-internal form')[0]),
        //             contentType : false,
        //             processData : false,
        //             success : function($data){
        //                 $('#form-teruskan-internal').hide();
        //                 $('body').removeClass('modal-open');
        //                 $('.modal-backdrop').remove();
        //                 $('#table-surat-keluar-internal').dataTable().api().ajax.reload();
        //                 swal({
        //                 title:'Berhasil!',
        //                 text:'Surat Masuk Sudah Dikirim ke Pimpinan',
        //                 type:'success',
        //                 timer:'1500'
        //                 })
        //             }
        //             });
        //             return false;
        //         }
        //     });
        // });

        
    </script>
@endpush