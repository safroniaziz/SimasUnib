<div class="row">
    <div class="col-md-4">
      <div class="form-group">
            <label for="tanggal_surat" class="control-label">Tanggal Surat Masuk :</label>
            <input type="date" name="tanggal_surat" id="tanggal_surat" class="form-control">
            
            @if($errors->has('tanggal_surat'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tanggal_surat') }}</strong>
                </span>
            @endif
        </div>
    
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
            <label for="" class="control-label">Jenis Surat :</label>
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
    
        <div class="form-group">
            <label for="" class="control-label">No Surat :</label>
            {!! Form::text('no_surat',null,['class' =>  'form-control','id' =>  'no_surat','placeholder'    =>  'nomor surat']) !!}
                @if($errors->has('no_surat'))
                    <li style="color: red">
                        {{$errors->first('no_surat')}}
                    </li>
                @endif
        </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
          <label for="" class="control-label">Pengirim Surat :</label>
          {!! Form::text('pengirim',null,['class' =>  'form-control','id' =>  'pengirim','placeholder'    =>  'pengirim surat']) !!}
      </div>
  
      <div class="form-group">
          <label for="" class="control-label">Perihal :</label>
          {!! Form::textarea('perihal',null,['class' =>  'form-control','id' =>  'perihal','rows' => 5, 'style' => 'resize:none']) !!}
      </div>
  
      <div class="form-group">
          <label for="" class="control-label">Sifat Surat :</label>
          <select name="sifat_surat" id="sifat_surat" class="form-control" >
              <option value="0" selected="true" disabled="true">-- pilih Jenis Surat --</option>    
              <option value="penting">Penting</option>
              <option value="rahasia">Rahasia</option>
          </select>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
          <label for="" class="control-label">Pengirim Surat :</label>
          {!! Form::text('pengirim',null,['class' =>  'form-control','id' =>  'pengirim','placeholder'    =>  'pengirim surat']) !!}
      </div>
  
      <div class="form-group">
          <label for="" class="control-label">Perihal :</label>
          {!! Form::textarea('perihal',null,['class' =>  'form-control','id' =>  'perihal','rows' => 5, 'style' => 'resize:none']) !!}
      </div>
  
      <div class="form-group">
          <label for="" class="control-label">Sifat Surat :</label>
          <select name="sifat_surat" id="sifat_surat" class="form-control" >
              <option value="0" selected="true" disabled="true">-- pilih Jenis Surat --</option>    
              <option value="penting">Penting</option>
              <option value="rahasia">Rahasia</option>
          </select>
      </div>
    </div>
    <div class="col-md-12">
        <button type="button" class="btn btn-danger" data-dismiss="modal">  <i class="fa fa-close"></i>  Batal</button>
                <button type="button" class="btn btn-primary" id="modal-btn-save" ></button>
    </div>
  </div>