{!! Form::model($model, [
    'route' =>  $model->exists ? ['admin.pejabat_disposisi.update',$model->id] : 'admin.pejabat_disposisi.store',
    'method'    =>  $model->exists ? 'PUT' : 'POST'
]) !!}
 
    <div class="form-group">
        <label for="" class="control-label">Satuan Kerja :</label>
        <select name="id_satuan_kerja" id="id_satuan_kerja" class="form-control" >
            <option value="0" selected="true" disabled="true">-- pilih satuan kerja --</option>    
            @foreach($id_satuan_kerja as $value)
                <option value="{{ $value->id}}" 
                    <?php 
                        if($value->id ==$model->id_satuan_kerja ){
                            echo "selected";
                        }
                    ?>
                >{{ $value->nm_satuan_kerja }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="" class="control-label">Nama Pejabat :</label>
        {!! Form::text('nm_pejabat',null,['class' =>  'form-control','id' =>  'nm_pejabat']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Nip Pejabat :</label>
        {!! Form::text('nip_pejabat',null,['class' =>  'form-control','id' =>  'nip_pejabat']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Jabatan :</label>
        <select name="id_jabatan" id="id_jabatan" class="form-control" >    
            <option value="0" selected="true" disabled="true">-- pilih jabatan --</option>    
            @foreach($id_jabatan as $value)
                <option value="{{ $value->id }}"
                
                <?php 
                    if($value->id ==$model->id_jabatan ){
                        echo "selected";
                    }
                ?>

                >{{ $value->nm_jabatan }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="" class="control-label">Telephone :</label>
        {!! Form::number('no_telephone',null,['class' =>  'form-control','id' =>  'no_telephone']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Email :</label>
        {!! Form::email('email',null,['class' =>  'form-control','id' =>  'email']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Level Disposisi :</label>
        {!! Form::email('level_disposisi',null,['class' =>  'form-control','id' =>  'level_disposisi']) !!}
    </div>

{!! Form::close() !!}