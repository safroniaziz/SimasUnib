<div id="form-surat-keluar-staf-tu" style="display:none;">
    <form method="POST" class="form-horizontal" id="form-surat-keluar" data-toggle="validator" role="">
        {{  csrf_field() }} {{ method_field('POST') }}
        <div class="row" id="form-add-edit">
            <input type="hidden" id="id" name="id">


            <input type="hidden" name="id_satuan_kerja_pengirim" class="form-control" value="{{ $id_pengirim[0]  }}">
            
            <div class="col-md-2 col-sm-3 col-12 img" style="padding:5px 10px;">
                <div class="form-group" id="password-form">
                        <span class="badge badge-danger" style="font-size:9px;">Harus Disertakan !</span>
                        <img class="foto-baru foto-surat" id="preview-foto" src="" style="border:3px #DC3545 solid;">
                        <input type="file" name="lampiran" id="lampiran" onchange="previewFoto()" class="file-upload-default">
                        <button class="file-upload-browse btn btn-info" type="button" style="width:150px; margin-top:2px;">Pilih Lampiran</button>
                </div>
            </div>
            <div class="col-md-10 col-sm-9 col-12">
                <div class="row">
                    <div class="form-group col-md-6 col-sm-6 col-12" id="form-jenis-surat" >
                        <label for="">Penerima Surat :</label>
                        <input type="text" name="penerima_surat" class="form-control" id="penerima_surat">
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-12" id="form-jenis-surat" >
                        <label for="">Jenis Surat :</label>
                        <select name="id_jenis_surat" id="id_jenis_surat" class="form-control">
                            <option value="0" selected="true">-- pilih jenis surat --</option>
                            <?php 
                                $id_jenis_surat = DB::table('tb_jenis_surat')->select('id','jenis_surat')->get();
                                foreach ($id_jenis_surat as $value) {
                                    ?>
                                        <option value="{{ $value->id }}">{{ $value->jenis_surat  }}</option>
                                    <?php
                                }    
                            ?>
                        </select>
                    </div>
        
                    <div class="form-group col-md-6 col-sm-6 col-12" id="form-sifat-surat" >
                        <label for="" class="control-label">Sifat Surat :</label>
                        <select name="sifat_surat" id="sifat_surat" class="form-control" >
                            <option value="0" selected="true" disabled="true">-- pilih sifat surat --</option>    
                            <option value="penting">Penting</option>
                            <option value="rahasia">Rahasia</option>
                        </select>
                    </div>
            
                    <div class="form-group col-md-6 col-sm-6 col-12">
                            <label for="" class="control-label">Nomor Surat :</label>
        
                        <div class="input-group">
                            <input type="text" name="no_surat" class="form-control" id="no_surat" placeholder="sifat surat">    
                            <div class="input-group-append bg-danger border-danger" id="no_surat_tersedia" style="display:none;">
                                <span class="input-group-text bg-transparent" style="color:white; font-size:11px;">
                                    <i class="fa fa-close"></i>&nbsp;sudah ada
                                </span>
                            </div>
        
                        </div> 
                    </div>
            
                    <div class="form-group col-md-6 col-sm-6 col-12" id="form-perihal">
                        <label for="" class="control-label">Perihal :</label>
                        <input type="text" name="perihal" class="form-control" id="perihal" placeholder="perihal">
                    </div>
            
                    <div class="form-group col-md-6 col-sm-6 col-12" id="form-tujuan">
                        <label for="" class="control-label">Tujuan :</label>
                        <input type="text" name="tujuan" class="form-control" id="tujuan" placeholder="tujuan">
                    </div>
            
                    <div class="form-group col-md-6 col-sm-6 col-12" id="form-catatan">
                        <label for="" class="control-label">Catatan :</label>
                        <input type="text" name="catatan" class="form-control" id="catatan" placeholder="catatan">
                    </div>
            
                    <div class="form-group col-md-6 col-sm-6 col-12" id="form-tanggal-surat">
                        <label for="" class="control-label">Tanggal Surat :</label>
                        <input type="date" name="tanggal_surat" class="form-control" id="tanggal_surat">
                    </div>
            
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div style="margin: 0 auto">
                <button type="reset" name="reset" class="btn btn-danger ">Batalkan</button>&nbsp;
                <button type="submit" id="submit" name="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>