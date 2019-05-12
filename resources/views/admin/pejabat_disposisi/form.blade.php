{!! Form::model($model, [
    'route' =>  $model->exists ? ['admin.pejabat_disposisi.update',$model->id] : 'admin.pejabat_disposisi.store',
    'method'    =>  $model->exists ? 'PUT' : 'POST'
]) !!}

    <div class="form-group">
        <label for="" class="control-label">Nama Pejabat :</label>
        <select name="id_pejabat" id="id_pejabat" class="form-control">
            <option value="0"  >-- pilih pejabat --</option>    
            <?php
                foreach($id_pejabat as $value){
                    ?>
                        <option value="{{  $value->id }}"
                            <?php 
                            if($model->id_pejabat == $value->id){
                                ?>
                                    selected
                                <?php
                            }
                        ?>        
                        >{{ $value->nm_user }}</option>
                    <?php
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="" class="control-label">Nama Pejabat Disposisi :</label>
        <select name="id_disposisi_pejabat" id="id_disposisi_pejabat" class="form-control" >
            <option value="0"  >-- pilih disposisi pejabat --</option>    
            <?php
                foreach($id_disposisi_pejabat as $value){
                    ?>
                        <option value="{{  $value->id }}"
                            <?php 
                                if($model->id_disposisi_pejabat == $value->id){
                                    ?>
                                        selected
                                    <?php
                                }
                            ?>        
                        >{{ $value->nm_user }}</option>
                    <?php
                }
            ?>
        </select>
    </div>
{!! Form::close() !!}