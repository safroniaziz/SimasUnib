<div class="modal fade" id="form-admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Nama Admin :</label>
                            <input type="text" name="nm_admin" class="form-control" id="nm_admin">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Username :</label>
                            {!! Form::text('username',null,['class' =>  'form-control','id' =>  'username']) !!}
                        </div>
                
                        <div class="form-group col-md-6" id="password-form">
                            <label for="" class="control-label">Password :</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
            
                        <div class="form-group col-md-6">
                            <label>Foto User</label>
                            <input type="file" name="foto" onchange="previewFoto()" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" id="upload-value" disabled placeholder="Upload Image">
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