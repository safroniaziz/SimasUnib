@php
    use App\Model\User;
@endphp
<div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" id="form" class="form-horizontal" data-toggle="validator">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="" class="control-label">Satuan Kerja :</label>
                        <select name="id_satuan_kerja" id="id_satuan_kerja" class="form-control" >
                            <option value="0" disabled="true">-- pilih satuan kerja --</option>    
                            <?php
                                $model = new User();
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
                        {!! Form::text('nm_user',null,['class' =>  'form-control','id' =>  'nm_user']) !!}
                    </div>
                
                    <div class="form-group">
                        <label for="" class="control-label">Username :</label>
                        {!! Form::text('username',null,['class' =>  'form-control','id' =>  'username']) !!}
                    </div>
                
                    <div class="form-group">
                        <label for="" class="control-label">Password :</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <input type="checkbox" onclick="cekPasswordFunction()"> Tampilkan Password
                    </div>
                
                    <div class="form-group">
                        <label for="" class="control-label">Foto :</label>
                        <input type="file" name="foto" id="foto" class="form-control-file">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>