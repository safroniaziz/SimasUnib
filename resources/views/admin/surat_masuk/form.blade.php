{!! Form::model($model, [
    'route' =>  $model->exists ? ['admin.surat_masuk.update',$model->id] : 'admin.surat_masuk.store',
    'method'    =>  $model->exists ? 'PUT' : 'POST'
]) !!}
 
    <div class="form-group">
        <label for="" class="control-label">Pejabat Disposisi :</label>
        <select name="id_pejabat_disposisi" id="id_pejabat_disposisi" class="form-control" >
            <option value="0" selected="true" disabled="true">-- pilih pejabat disposisi --</option>    
            @foreach($id_pejabat_disposisi as $value)
                <option value="{{ $value->id}}" 
                    <?php 
                        if($value->id ==$model->id_pejabat_disposisi ){
                            echo "selected";
                        }
                    ?>
                >{{ $value->nm_pejabat }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="" class="control-label">Pejabat Disposisi :</label>
        <select name="id_jenis_surat" id="id_jenis_surat" class="form-control" >
            <option value="0" selected="true" disabled="true">-- pilih Jenis Surat --</option>    
            @foreach($id_jenis_surat as $value)
                <option value="{{ $value->id}}" 
                    <?php 
                        if($value->id ==$model->id_jenis_surat ){
                            echo "selected";
                        }
                    ?>
                >{{ $value->jenis_surat }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group row">
        <div class="col">
            <label>Nomor Surat:</label>
            <input class="form-control" data-inputmask="'alias': 'email'" />
        </div>
        <div class="col">
            <label></label>
            <input class="form-control" data-inputmask="'alias': 'ip'" />
        </div>
        <div class="col">
            <label></label>
            <input class="form-control" data-inputmask="'alias': 'ip'" />
        </div>    
    </div>

    <div class="form-group">
        <label for="" class="control-label">No Surat :</label>
        {!! Form::text('nm_satuan_kerja_singkat',null,['class' =>  'form-control','id' =>  'nm_satuan_kerja_singkat']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Telephone :</label>
        {!! Form::text('no_hp',null,['class' =>  'form-control','id' =>  'no_hp']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Website :</label>
        {!! Form::text('website',null,['class' =>  'form-control','id' =>  'website']) !!}
    </div>

{!! Form::close() !!}