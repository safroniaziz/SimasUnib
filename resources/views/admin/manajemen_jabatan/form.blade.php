{!! Form::model($model, [
    'route' =>  $model->exists ? ['admin.manajemen_jabatan.update',$model->id] : 'admin.manajemen_jabatan.store',
    'method'    =>  $model->exists ? 'PUT' : 'POST'
]) !!}
 
    <div class="form-group">
        <label for="" class="control-label">Nama Satuan Kerja :</label>
        <select name="id_satuan_kerja" id="id_satuan_kerja" class="form-control" >
            <option value="0"  >-- pilih satuan kerja --</option>    
            <?php
                $id_satuan_kerja = DB::table('tb_satuan_kerja')->select('id','nm_satuan_kerja')->get();
                foreach($id_satuan_kerja as $value){
                    ?>
                        <option value="{{  $value->id }}"
                            <?php 
                                if($model->id_satuan_kerja == $value->id)
                                {
                                    ?>
                                        selected
                                    <?php
                                }    
                            ?>    
                        >{{ $value->nm_satuan_kerja }}</option>
                    <?php
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="" class="control-label">Nama Jabatan :</label>
        {!! Form::text('nm_jabatan',null,['class' =>  'form-control','id' =>  'nm_jabatan']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Keterangan :</label>
        {!! Form::textarea('keterangan',null,['class' =>  'form-control','id' =>  'keterangan','rows' => 5, 'style' => 'resize:none']) !!}
    </div>

{!! Form::close() !!}