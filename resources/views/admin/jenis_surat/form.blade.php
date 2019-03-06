{!! Form::model($model, [
    'route' =>  $model->exists ? ['admin.jenis_surat.update',$model->id] : 'admin.jenis_surat.store',
    'method'    =>  $model->exists ? 'PUT' : 'POST'
]) !!}

    <div class="form-group">
        <label for="" class="control-label">Jenis Surat :</label>
        {!! Form::text('jenis_surat',null,['class' =>  'form-control','id' =>  'jenis_surat']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Keterangan :</label>
        {!! Form::textarea('keterangan',null,['class' =>  'form-control','id' =>  'keterangan','rows' => 5, 'style' => 'resize:none']) !!}
    </div>

{!! Form::close() !!}