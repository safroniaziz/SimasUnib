{!! Form::model($model, [
    'route' =>  $model->exists ? ['admin.kode_surat.update',$model->id_kode_surat] : 'admin.kode_surat.store',
    'method'    =>  $model->exists ? 'PUT' : 'POST'
]) !!}

    <div class="form-group">
        <label for="" class="control-label">Kode Surat :</label>
        {!! Form::text('kode_surat',null,['class' =>  'form-control','id' =>  'kode_surat']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Keterangan :</label>
        {!! Form::textarea('keterangan',null,['class' =>  'form-control','id' =>  'keterangan','rows' => 5, 'style' => 'resize:none']) !!}
    </div>

{!! Form::close() !!}