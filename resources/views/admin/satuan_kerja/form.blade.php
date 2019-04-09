{!! Form::model($model, [
    'route' =>  $model->exists ? ['admin.satuan_kerja.update',$model->id] : 'admin.satuan_kerja.store',
    'method'    =>  $model->exists ? 'PUT' : 'POST'
]) !!}
 
    <div class="form-group">
        <label for="" class="control-label">Nama Satuan Kerja :</label>
        {!! Form::text('nm_satuan_kerja',null,['class' =>  'form-control','id' =>  'nm_satuan_kerja']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Nama Satuan Kerja Singkat :</label>
        {!! Form::text('nm_satuan_kerja_singkat',null,['class' =>  'form-control','id' =>  'nm_satuan_kerja_singkat']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Website :</label>
        {!! Form::text('website',null,['class' =>  'form-control','id' =>  'website']) !!}
    </div>

{!! Form::close() !!}