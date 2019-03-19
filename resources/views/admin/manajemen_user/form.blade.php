<div class="row form-user" style="display:none;">
        <div class="col-md-6">
            <div class="form-group" id="idUser">
                <label for="" class="control-label">ID User :</label>
                <input type="number" class="form-control" readonly="readonly">
            </div>
            <div class="form-group">
                <label for="" class="control-label">Satuan Kerja :</label>
                <select name="id_satuan_kerja" id="id_satuan_kerja" class="form-control" >
                    <option value="0" disabled="true">-- pilih satuan kerja --</option>    
                    <?php
                        $id_satuan_kerja = DB::table('tb_satuan_kerja')->select('id','nm_satuan_kerja')->get();
                        foreach($id_satuan_kerja as $value){
                            ?>
                                <option value="{{  $value->id }}">{{ $value->nm_satuan_kerja }}</option>
                            <?php
                        }
                    ?>
                </select>
            </div>
  
            <div class="form-group">
                <label for="" class="control-label">Nama User :</label>
                <input type="text" name="nm_user" class="form-control" id="nm_user">
            </div>
        
            <div class="form-group">
                <label for="" class="control-label">Username :</label>
                {!! Form::text('username',null,['class' =>  'form-control','id' =>  'username']) !!}
            </div>
        </div>
  
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="control-label">Password :</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
  
            <div class="form-group">
                <label>Foto User</label>
                <input type="file" name="img[]" class="file-upload-default">
                <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                    <span class="input-group-append">
                    <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                    </span>
                </div>
            </div>
        
            <div class="form-group">
                <label for="" class="control-label">Level User :</label>
                <select name="level" id="level" class="form-control">
                    <option value="0" selected="true" disabled="true">-- pilih level user --</option>    
                    <option value="administrator">Administrator</option>
                    <option value="staf_tu">Staf Tata Usaha</option>
                    <option value="pimpinan">Pimpinan</option>
                </select>
            </div>
        </div>
        <div class="col-md-12 text-center" style="margin-bottom: 5px;" >
                <button type="reset" name="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Reset</button>
                <button type="submit" id="simpanUser" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>