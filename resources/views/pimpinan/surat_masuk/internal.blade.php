@extends('layouts/template')
@section('page-title')
    Pimpinan - Surat Masuk
@endsection
@section('sidebar-menu')
    @include('pimpinan/sidebar-menu')
@endsection
@section('manajemen-icon')
  <i class="mdi mdi-email icon-md text-dark"></i>
@endsection
@section('manajemen-title','Daftar Surat Masuk')
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
    </style>
@endpush
@section('manajemen-table')
    @include('pimpinan/surat_masuk.form')
    @if (\Session::has('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Pemberitahuan :</strong> {!! \Session::get('success') !!}
        </div>
    @endif
    
    <div class="row">
        <div class="col-12 table-responsive">
        <table id="data-surat-masuk-internal-pimpinan" class="table dt-responsive table-hover table-striped table-bordered nowrap " style="width:100%;">
            <thead>
                <tr class="tr-header">
                    <td>No</td>
                    <td>Tipe Surat</td>
                    <td>Satker Pengirim Surat</td>
                    <td>Satker Penerima Surat</td>
                    <td>Pimpinan Penerima Surat</td>
                    <td>Penerima Disposisi Surat</td>
                    <td>Jenis Surat</td>
                    <td>No Surat</td>
                    <td>Perihal</td>
                    <td>Tujuan</td>
                    <td>lampiran</td>
                    <td>Catatan</td>
                    <td>Sifat Surat</td>
                    <td>Tanggal Surat</td>
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
        $('#data-surat-masuk-internal-pimpinan').DataTable({
            responsive: true,
            processing: true,
            serverside: true,
            ajax: "{{ route('pimpinan.surat_masuk_internal.api') }}",
            columns: [
                {data: 'rownum',name:'rownum'},
                {data: 'tipe_surat',name:'tipe_surat'},
                {data: 'nm_pengirim_surat',name:'nm_pengirim_surat'},
                {data: 'nm_penerima_surat',name:'nm_penerima_surat'},
                {data: 'nm_pimpinan_penerima_surat', 
                        render:function(data, type, row){
                            if(data == null)
                            {
                                return '<label class="badge badge-warning" style="font-size:11px;">'+'<i class="fa fa-spinner"></i>'+'&nbsp;data belum diisi'+'</label>';
                            }
                            else
                            {
                                return '<style="font-size:11px;">'+data;
                            }
                        }
                },
                {data: 'nm_penerima_disposisi', 
                        render:function(data, type, row){
                            if(data == null)
                            {
                                return '<label class="badge badge-warning" style="font-size:11px;">'+'<i class="fa fa-spinner"></i>'+'&nbsp;data belum diisi'+'</label>';
                            }
                            else
                            {
                                return '<style="font-size:11px;">'+data;
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
                {data: 'action',name:'action'},
                
            ],
            
        })

        // $(function() {
        //     $('#sifat_surat').on('change', function() {
        //         var sifat_surat = $('#sifat_surat option:selected[value="0"]');
        //         $("#submit").attr("disabled", sifat_surat.val() == 0);
        //     }).change();
        // });

      
        function teruskanSuratMasukInternal(id){
            save_method = 'teruskan';
            $('input[name=_method]').val('PATCH');
            $.ajax({
                url: "{{ url('pimpinan/surat_masuk_internal') }}"+'/'+ id + "/teruskan",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $("#form-surat-masuk-pimpinan").show(300);
                    $("#form-add-edit").hide();
                    $("#form-teruskan").show();
                    $("#detail-teruskan").show();
                    $(window).scrollTop(0);
                    $('#id').text(data[0].id);
                    $('#id_surat_masuk').text(data[0].id);
                    $('#tipe_suratt').text(data[0].tipe_surat);
                    $('#satker_pengirim_suratt').text(data[0].nm_satker_pengirim_surat);
                    $('#jenis_suratt').text(data[0].jenis_surat);
                    $('#nomor_suratt').text(data[0].no_surat);
                    $('#perihal_suratt').text(data[0].perihal);
                    $('#tujuan_suratt').text(data[0].tujuan);
                    $('#catatan_suratt').text(data[0].catatan);
                    $('#sifat_suratt').text(data[0].sifat_surat);
                    $('#id_surat_masuk').val(data[0].id);

                    $('#id').val(data[0].id);
                    $('#tipe_surat').val(data[0].tipe_surat);
                    $('#id_satker_pengirim_surat').val(data[0].id_satker_pengirim_surat);
                    $('#id_jenis_surat').val(data[0].id_jenis_surat);
                    $('#sifat_surat').val(data[0].sifat_surat);
                    $('#no_surat').val(data[0].no_surat);
                    $('#perihal').val(data[0].perihal);
                    $('#tujuan').val(data[0].tujuan);
                    $('#catatan').val(data[0].catatan);
                    $('#tanggal_surat').val(data[0].tanggal_surat);
                    $('#lampiran').val(data[0].lampiran);

                },
                error:function(){
                    alert("Nothing Data");
                }
            });
        }

        $(function(){
            
            $('#form-surat-masuk-pimpinan form').validator().on('submit', function(e){
                $.ajaxSetup({
      headers: {
        'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == 'teruskan') url = "{{ url('pimpinan/surat_masuk_internal/teruskan').'/' }}"+id;
                    
                    $.ajax({
                    url : url,
                    type : "POST",
                    // data : $('#form-surat-masuk-pimpinan form').serialize(),
                    data : new FormData($('#form-surat-masuk-pimpinan form')[0]),
                    contentType : false,
                    processData : false,
                    success : function($data){
                        $('#form-surat-masuk-pimpinan').hide();
                        $('#table-surat-masuk-internal').dataTable().api().ajax.reload();
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

        // $(function(){

        //     $('#form-teruskan-internal form').validator().on('submit', function(e){
                
        //         if (!e.isDefaultPrevented()) {
        //             var id = $('#id').val();
        //             if (save_method == 'teruskan') url = "{{ url('pimpinan/surat_masuk_internal').'/' }}"+id;
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
        //                 $('#table-surat-masuk-internal').dataTable().api().ajax.reload();
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