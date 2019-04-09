<div id="form-surat-masuk-staf-tu" style="display:none;">
        <form action="" method="POST" class="form-horizontal" data-toggle="validator" role="">
            {{  csrf_field() }} {{ method_field('POST') }}
            <div class="row">
                <input type="hidden" id="id" name="id">
                <div id="form-eksternal" class=" col-md-3">
                    <label for="">Masukan Pengirim Surat :</label>
                    <input type="text" name="pengirim_surat" id="pengirim_surat" class="form-control" placeholder="instansi pengirim surat">                      
                </div>
        
                <div class="form-group col-md-3" id="form-jenis-surat" onchange="pilih_jenis_surat()">
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
    
                <div class="form-group col-md-3" id="form-sifat-surat" onchange="pilih_sifat_surat()">
                    <label for="" class="control-label">Sifat Surat :</label>
                    <select name="sifat_surat" id="sifat_surat" class="form-control" >
                        <option value="0" selected="true" disabled="true">-- pilih sifat surat --</option>    
                        <option value="penting">Penting</option>
                        <option value="rahasia">Rahasia</option>
                    </select>
                </div>
        
                <div class="form-group col-md-3" id="form-no-surat">
                    <label for="" class="control-label">Nomor Surat :</label>
                    <input type="text" name="no_surat" class="form-control" id="no_surat" placeholder="nomor surat">
                </div>
        
                <div class="form-group col-md-3" id="form-perihal">
                    <label for="" class="control-label">Perihal :</label>
                    <input type="text" name="perihal" class="form-control" id="perihal" placeholder="perihal">
                </div>
        
                <div class="form-group col-md-3" id="form-tujuan">
                    <label for="" class="control-label">Tujuan :</label>
                    <input type="text" name="tujuan" class="form-control" id="tujuan" placeholder="tujuan">
                </div>
        
                <div class="form-group col-md-3" id="form-catatan">
                    <label for="" class="control-label">Catatan :</label>
                    <input type="text" name="catatan" class="form-control" id="catatan" placeholder="catatan">
                </div>
        
                <div class="form-group col-md-3" id="form-tanggal-surat">
                    <label for="" class="control-label">Tanggal Surat :</label>
                    <input type="date" name="tanggal_surat" class="form-control" id="tanggal_surat" value="{{ $waktu2 }}">
                </div>
        
                <div class="form-group col-md-3" id="form-lampiran">
                    <label>File Lampiran</label>
                    <input type="file" name="lampiran" onchange="previewFoto()" class="file-upload-default">
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" id="upload-value" disabled placeholder="Upload File">
                        <span class="input-group-append">
                        <button class="file-upload-browse btn btn-info" type="button">Cari</button>
                        </span>
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