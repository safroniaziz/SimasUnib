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
        td.highlight {
        font-weight: bold;
        color: blue;
    }
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
        <table id="data-surat-masuk-eksternal-pimpinan" class="table dt-responsive table-hover table-striped table-bordered nowrap " style="width:100%;">
            <thead>
                <tr class="tr-header">
                    <td>No</td>
                    <td>Pengirim Surat</td>
                    <td>Pengirim Disposisi Surat</td>
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
        $('#data-surat-masuk-eksternal-pimpinan').DataTable({
            
            responsive: true,
            processing: true,
            serverside: true,
            
            ajax: "{{ route('pimpinan.surat_masuk_eksternal.api') }}",
            
            columns: [
                {data: 'rownum',name:'rownum'},
                {data: 'pengirim_surat',name:'pengirim_surat'},
                {data: 'nm_pengirim_disposisi',name:'nm_pengirim_disposisi'},
                {data: 'jenis_surat',name:'jenis_surat'},
                {data: 'no_surat',name:'no_surat'},
                {data: 'perihal',name:'perihal'},
                {data: 'tujuan',name:'tujuan'},
                {data: 'lampiran',name:'lampiran'},
                {data: 'tanggal_surat',name:'tanggal_surat'},
                {data: 'catatan',name:'catatan'},
                {data: 'sifat_surat',name:'sifat_surat'},
                {data: 'status_baca', 
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
                              return '<label class="badge badge-success" style="font-size:11px;">'+'<i class="fa fa-check"></i>'+'&nbsp;Sudah Diteruskan'+'</label>';
                            }
                            else
                            {
                              return '<label class="badge badge-warning" style="font-size:11px;">'+'<i class="fa fa-spinner"></i>'+'&nbsp;Menunggu Diteruskan'+'</label>';
                            }
                        }
                },
                {data: 'action',name:'action'},
                
            ],
            "createdRow": function ( row, data, index ) {
                if(data['status_teruskan'] == 0 ) {
                    $('td', row).css('background-color', '#f2dede' );
                }
            },
            
            
        })

        // $(function() {
        //     $('#sifat_surat').on('change', function() {
        //         var sifat_surat = $('#sifat_surat option:selected[value="0"]');
        //         $("#submit").attr("disabled", sifat_surat.val() == 0);
        //     }).change();
        // });

      
        function teruskanSuratMasukEksternalPimpinan(id){
            save_method = 'teruskan';
            $('input[name=_method]').val('POST');
            $.ajax({
                url: "{{ url('pimpinan/surat_masuk_eksternal') }}"+'/'+ id + "/teruskan",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $("#form-surat-masuk-pimpinan").show(300);
                    $("#form-add-edit").hide();
                    $("#form-teruskan").show();
                    $("#detail-teruskan").show();
                    $(window).scrollTop(0);
                    $('#id_disposisi_surat_masuk').val(data[0].id_disposisi_surat_masuk);
                    $('#id_surat_masuk').text(data[0].id_surat_masuk);
                    $('#tipe_suratt').text(data[0].tipe_surat);
                    $('#satker_pengirim_suratt').text(data[0].pengirim_surat);
                    $('#jenis_suratt').text(data[0].jenis_surat);
                    $('#nomor_suratt').text(data[0].no_surat);
                    $('#perihal_suratt').text(data[0].perihal);
                    $('#tujuan_suratt').text(data[0].tujuan);
                    $('#catatan_suratt').text(data[0].catatan);
                    $('#sifat_suratt').text(data[0].sifat_surat);
                    $('#id_surat_masuk').val(data[0].id);
                    $('.detail_lampiran_teruskan').attr("src",data[0].lampiran);
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
                    if(save_method == 'teruskan') url = "{{ url('pimpinan/surat_masuk_internal/teruskan_surat') }}";
                    $.ajax({
                    url : url,
                    type : "POST",
                    // data : $('#form-surat-masuk-pimpinan form').serialize(),
                    data : new FormData($('#form-surat-masuk-pimpinan form')[0]),
                    contentType : false,
                    processData : false,
                    success : function(data){
                        // alert(data);
                        $('#form-surat-masuk-pimpinan').hide();
                        $('#data-surat-masuk-internal-pimpinan').dataTable().api().ajax.reload();
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
        //                 $('#data-surat-masuk-internal-pimpinan').dataTable().api().ajax.reload();
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