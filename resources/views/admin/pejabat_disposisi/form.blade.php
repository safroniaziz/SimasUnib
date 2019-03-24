<div class="modal fade" id="form-pejabat-disposisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" class="form-horizontal" data-toggle="validator">
                {{Form::token()}} {{ method_field('POST') }}
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Nama Pejabat :</label>
                            {!! Form::text('nm_pejabat',null,['class' =>  'form-control','id' =>  'nm_pejabat']) !!}
                        </div>
                
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Nip Pejabat :</label>
                            {!! Form::text('nip_pejabat',null,['class' =>  'form-control','id' =>  'nip_pejabat']) !!}
                        </div>
                
                        <div class="form-group col-md-6" id="password-form">
                            <label for="" class="control-label">Telephone :</label>
                            {!! Form::number('no_telephone',null,['class' =>  'form-control','id' =>  'no_telephone']) !!}
                        </div>
            
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Email :</label>
                            {!! Form::email('email',null,['class' =>  'form-control','id' =>  'email']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; Batal</button>
                    <button type="submit" id="submit-form" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                </div>
            </form>
        </div>
    </div>
    </div>