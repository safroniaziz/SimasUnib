<div class="modal fade" id="form-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" class="form-horizontal" data-toggle="validator">
                {{Form::token()}} {{ method_field('POST') }}
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="form-group col-md-6" id="id_jabatan_edit">
                            <label for="" class="control-label">Jabatan :</label>
                            <select name="id_jabatan" id="id_jabatan" class="form-control" >
                                <option value="0"  >-- pilih jabatan --</option>    
                                <?php
                                    foreach($id_jabatan as $value){
                                        ?>
                                            <option value="{{  $value->id }}">{{ $value->nm_jabatan }}</option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6" id="jabatan_edit">
                            <label for="" class="control-label">Jabatan :</label>
                            <input type="text" class="form-control" id="jabatan">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Level User :</label>
                            <select name="level_user" id="level_user" class="form-control">
                                <option value="0" selected="true" disabled="true">-- pilih level user --</option>    
                                <option value="pimpinan">Pimpinan</option>
                                <option value="staf_tu">Staf Tata Usaha</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                                <label for="" class="control-label">Nomor Induk Pegawai :</label>

                            <div class="input-group">
                                <input type="number" name="nip" class="form-control" id="nip">    
                                <div class="input-group-append bg-success border-success" id="mencari_nip">
                                        <span class="input-group-text bg-transparent">
                                            <i class="fa fa-check"></i>
                                        </span>
                                    </div>

                                <div class="input-group-append bg-danger border-danger" id="nip_tersedia" style="display:none;">
                                    <span class="input-group-text bg-transparent" style="color:white; font-size:11px;">
                                        <i class="fa fa-close"></i>&nbsp;sudah digunakan
                                    </span>
                                </div>

                            </div> 
                        </div>
                
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Nama User :</label>
                            <input type="text" name="nm_user" class="form-control" id="nm_user">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Username :</label>

                            <div class="input-group">
                                <input type="text" name="username" class="form-control" id="username">    
                                <div class="input-group-append bg-success border-success" id="mencari_username">
                                        <span class="input-group-text bg-transparent">
                                            <i class="fa fa-check"></i>
                                        </span>
                                    </div>

                                <div class="input-group-append bg-danger border-danger" id="username_tersedia" style="display:none;">
                                    <span class="input-group-text bg-transparent" style="color:white; font-size:11px;">
                                        <i class="fa fa-close"></i>&nbsp;sudah digunakan
                                    </span>
                                </div>

                            </div> 
                        </div>

                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Email :</label>

                            <div class="input-group">
                                <input type="email" name="email" class="form-control" id="email">    
                                <div class="input-group-append bg-success border-success" id="mencari_email">
                                        <span class="input-group-text bg-transparent">
                                            <i class="fa fa-check"></i>
                                        </span>
                                    </div>

                                <div class="input-group-append bg-danger border-danger" id="email_tersedia" style="display:none;">
                                    <span class="input-group-text bg-transparent" style="color:white; font-size:11px;">
                                        <i class="fa fa-close"></i>&nbsp;sudah digunakan
                                    </span>
                                </div>

                            </div> 
                        </div>

                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Telephone :</label>
                            {!! Form::text('telephone',null,['class' =>  'form-control','id' =>  'telephone']) !!}
                        </div>
                
                        <div class="form-group col-md-6" id="password-form">
                            <label for="" class="control-label">Password :</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
            
                        <div class="form-group col-md-6">
                            <label>Foto User</label>
                            <input type="file" name="foto" id="foto" onchange="previewFoto()" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info upload_value" id="upload-value" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="password-form">
                                <img class="foto-baru" id="preview-foto" src="" height="100" width="100" alt="" style="font-size:12px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; Batal</button>
                    <button type="submit" id="submit-form" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                </div>
            </form>
        </div>
    </div>
    </div>