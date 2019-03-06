{!! Form::model($model, [
    'route' =>  $model->exists ? ['admin.manajemen_jabatan.update',$model->id] : 'admin.manajemen_jabatan.store',
    'method'    =>  $model->exists ? 'PUT' : 'POST'
]) !!}
 
    <div class="form-group">
        <label for="" class="control-label">Nama Jabatan :</label>
        {!! Form::text('nm_jabatan',null,['class' =>  'form-control','id' =>  'nm_jabatan']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Keterangan :</label>
        {!! Form::textarea('keterangan',null,['class' =>  'form-control','id' =>  'keterangan','rows' => 5, 'style' => 'resize:none']) !!}
    </div>

{!! Form::close() !!}