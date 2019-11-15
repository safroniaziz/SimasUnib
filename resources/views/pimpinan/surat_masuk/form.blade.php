<div id="form-surat-masuk-pimpinan" style="display:none;">
        <form method="POST" class="form-horizontal" id="form-surat-masuk" data-toggle="validator" role="">
            {{  csrf_field() }} {{ method_field('POST') }}

            <div class="row" id="detail-teruskan">
                <div class="col-md-12">
                    <span class="badge badge-success"><i class="fa fa-info"></i>&nbsp;Detail Inforamsi Surat</span>
                    <table class="table table-bordered">
                        <tr>
                            <td rowspan="4">
                               <img class="detail_lampiran_teruskan" src="" alt="" style="height:150px !important; width:100px !important;">
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
            <div id="form-teruskan">
                <span class="badge badge-danger" style="font-size:10px !important;"><i class="fa fa-info"></i>&nbsp;Hanya bisa diteruskan ke pimpinan satuan kerja bersangkutan</span>
                <br>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border" style="font-size:12px !important;">Form Teruskan Surat Internal</legend>
                    <div class="row">
                            <input type="hidden" name="id_disposisi_surat_masuk" id="id_disposisi_surat_masuk" class="form-control">
                            <input type="hidden" name="id_surat_masuk" class="form-control" id="id_surat_masuk">
                            <input type="hidden" name="id_pengirim_disposisi" class="form-control" value="{{ Auth::user()->id  }}" id="id_pengirim_disposisi">
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Pengirim Surat :</label>
                            <input type="text" name="nm_pengirim_surat" class="form-control" id="nm_pengirim_surat" value="{{ Auth::user()->nm_user }}" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Teruskan Kepada :</label>
                            <select name="id_pimpinan_penerima_surat" id="id_pimpinan_penerima_surat" class="form-control">
                                <option value="0">-- pilih penerima disposisi --</option>
                                @foreach ($id_penerima_disposisi as $value)
                                    <option value="{{ $value->id }}">{{ $value->nm_user }} ({{$value->nm_jabatan}})</option>                                        
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="row">
                <div style="margin: 0 auto">
                    <button type="reset" name="reset" class="btn btn-danger ">Batalkan</button>&nbsp;
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>