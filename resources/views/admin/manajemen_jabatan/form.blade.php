<div class="modal fade" id="form-jabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document">
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
                            <div class="form-group col-md-12">
                                <label for="" class="control-label">Nama Satuan Kerja :</label>
                                <select name="id_satuan_kerja" id="id_satuan_kerja" class="form-control" >
                                    <option value="0"  >-- pilih satuan kerja --</option>    
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
                        
                            <div class="form-group col-md-12">
                                    <label for="" class="control-label">Nama Jabatan :</label>
                        
                                    <div class="input-group">
                                        <input type="text" name="nm_jabatan" class="form-control" id="nm_jabatan">    
                                        <div class="input-group-append bg-success border-success" id="mencari_nm_jabatan">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="fa fa-check"></i>
                                                </span>
                                            </div>
                        
                                        <div class="input-group-append bg-danger border-danger" id="nm_jabatan_tersedia" style="display:none;">
                                            <span class="input-group-text bg-transparent" style="color:white; font-size:11px;">
                                                <i class="fa fa-close"></i>&nbsp;sudah digunakan
                                            </span>
                                        </div>
                        
                                    </div> 
                                </div>
                        
                            <div class="form-group col-md-12">
                                <label for="" class="control-label">Keterangan :</label>
                                {!! Form::textarea('keterangan',null,['class' =>  'form-control','id' =>  'keterangan','rows' => 5, 'style' => 'resize:none']) !!}
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