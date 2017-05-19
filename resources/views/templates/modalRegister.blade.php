<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalRegister">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalRegister">Rejoignez-nous !</h4>
            </div>

            {!! Form::open(['url' => 'register', 'class' => 'notRedirect', 'id' => 'formRegister']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('emailRegister','Saisissez votre adresse e-mail') !!}
                    {!! Form::email('email','', ['id' => 'emailRegister','class' => 'form-control', 'required' => 'true']) !!}
                    {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                    
                    <div class="alert alert-dismissible alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Un email de confirmation vous a été adressé.
                    </div>
                    <div class="alert alert-dismissible alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Un compte existe déjà à cette adresse.
                    </div>
                    <div class="alert alert-dismissible alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Impossible d'envoyer l'email de confirmation.
                    </div>
                
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                {!! Form::submit("S'inscrire", ['class' => 'btn btn-success pull-right']) !!}
            </div>

            {!! Form::close() !!}
        
        </div>
    </div>
</div>