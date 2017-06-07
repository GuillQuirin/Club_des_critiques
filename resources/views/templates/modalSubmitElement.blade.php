<div class="modal fade" id="submitElement" tabindex="-1" role="dialog" aria-labelledby="myModalSubmit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalSubmit">Proposer une oeuvre</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'login', 'class' => 'notRedirect', 'id' => 'formLogin']) !!}
                <div class="form-group">
                    {!! Form::label('emailLogin','Saisissez votre adresse e-mail') !!}
                    {!! Form::email('email','',['id'=>'emailLogin',
                                                'class' => 'form-control',
                                                'required' => 'required']) !!}
                    {!! $errors->first('emailLogin', '<small class="help-block">:message</small>') !!}

                    {!! Form::label('passwordLogin','Saisissez votre mot de passe') !!}
                    {!! Form::password('password',[ 'id' => 'passwordLogin',
                                                    'class' => 'form-control',
                                                    'required' => 'required']) !!}
                    {!! $errors->first('passwordLogin', '<small class="help-block">:message</small>') !!}
                    <div class="alert alert-dismissible alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Vous êtes déjà connectés, merci de rafraichir la page.
                    </div>
                    <div class="alert alert-dismissible alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Les identifiants sont incorrects.
                    </div>
                    <div class="alert alert-dismissible alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Authentification impossible.
                    </div>
                </div>
                <div class="row">
                    <span class="col-xs-6 col-sm-6 col-md-6 text-left">
                        <a  class="btn btn-warning" role="button" data-toggle="collapse" 
                        href="#forgetPwd" aria-expanded="false" aria-controls="forgetPwd">
                        Mot de passe oublié ?</a>
                    </span>
                    <span class="col-xs-6 col-sm-6 col-md-6 text-right">
                        {!! Form::submit("Se connecter", ['class' => 'btn btn-success']) !!}
                    </span>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>