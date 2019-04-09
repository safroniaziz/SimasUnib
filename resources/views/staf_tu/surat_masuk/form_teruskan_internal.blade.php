<div class="modal fade" id="form-teruskan-internal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-right:0px !important;">
    <div class="modal-dialog" style="max-width:700px;" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <form method="POST" class="form-horizontal" data-toggle="validator">
                {{Form::token()}} {{ method_field('POST') }}
                <div class="modal-body"style="max-width:700px;overflow-x: auto;">
                    <input type="hidden" id="id" name="id">
                    <span class="badge badge-success"><i class="fa fa-info"></i>&nbsp;Detail Inforamsi Surat</span>
                     <div class="row">
                         <div class="col-md-12">
                             <table class="table table-bordered">
                                 <tr>
                                     <td rowspan="4">
                                        <img src="{{ asset('assets/img/logo-utama.png')  }}" alt="">
                                     </td>
                                     <td style="font-weight:bold;">Tipe Surat</td>
                                     <td> : </td>
                                     <td id="tipe_suratt">
                                         
                                     </td>
                                    <td style="font-weight:bold;">Satuan Kerja Pengirim</td>
                                    <td> : </td>
                                    <td id="satker_pengirim_suratt">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">Jenis Surat</td>
                                    <td> : </td>
                                    <td id="jenis_suratt">
                                    </td>

                                    <td style="font-weight:bold;">Nomor Surat</td>
                                    <td> : </td>
                                    <td id="nomor_suratt">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">Perihal</td>
                                    <td> : </td>
                                    <td id="perihal_suratt">
                                    </td>

                                    <td style="font-weight:bold;">Tujuan</td>
                                    <td> : </td>
                                    <td id="tujuan_suratt">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">Catatan</td>
                                    <td> : </td>
                                    <td id="catatan_suratt">
                                    </td>
                                    <td style="font-weight:bold;">Sifat Surat</td>
                                    <td> : </td>
                                    <td id="sifat_suratt">
                                    </td>
                                </tr>
                             </table>
                         </div>
                     </div>
                     <br>
                     <span class="badge badge-danger" style="font-size:10px !important;"><i class="fa fa-info"></i>&nbsp;Hanya bisa diteruskan ke pimpinan satuan kerja bersangkutan</span>
                     <br>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border" style="font-size:12px !important;">Form Teruskan Surat Internal</legend>
                        <div class="row">
                                <input type="hidden" name="id_surat_masuk" class="form-control" id="id_surat_masuk">
                                <input type="hidden" name="id_pengirim_disposisi" class="form-control" value="{{ Auth::user()->id  }}" id="id_pengirim_disposisi">
                            <div class="form-group col-md-6">
                                <label for="" class="control-label">Pengirim Surat :</label>
                                <input type="text" name="nm_pengirim_surat" class="form-control" id="nm_pengirim_surat" value="{{ Auth::user()->nm_user }}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="" class="control-label">Teruskan Kepada :</label>
                                <select name="id_penerima_disposisi" id="id_penerima_disposisi" class="form-control">
                                    <option value="0">-- pilih penerima disposisi --</option>
                                    @foreach ($id_penerima_disposisi as $value)
                                        <option value="{{ $value->id }}">{{ $value->nm_user }}</option>                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; Batal</button>
                    <button type="submit" id="submit-form" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                </div>
            </form>
        </div>
    </div>
    </div>