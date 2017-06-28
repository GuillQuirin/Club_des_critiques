<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLogin">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLogin">Accès à votre compte utilisateur</h4>
            </div>
            <div class="modal-body">
                <!-- Authentification -->
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
                    <div class="alert alert-dismissible alert-danger-login alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Votre compte n'est pas accessible : vous devez avoir reçu un lien de confirmation par mail, ou vous avez été banni.
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

                <!-- Récupération de mot de passe -->
                <div class="collapse" id="forgetPwd">
                    <button type="button" class="close" data-dismiss="collapse" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <hr>
                    <div class="text-center">
                        <h4 class="modal-title">Récupération de votre compte</h4>
                    </div>
                    <hr>
                    {!! Form::open(['url' => 'forgot', 'class' => 'notRedirect', 'id' => 'formBackUp']) !!}
                    <div class="form-group">
                        {!! Form::label('emailBackUp','Un email vous sera envoyé.') !!}
                        {!! Form::email('email','',['id' => 'emailBackUp',
                                                    'class' => 'form-control',
                                                    'required' => 'required']) !!}
                        {!! $errors->first('emailBackUp', '<small class="help-block">:message</small>') !!}
                        <div class="alert alert-dismissible alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            L'email de récupération vient de vous être adressé.
                        </div>
                        <div class="alert alert-dismissible alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            Aucun compte n'est associé à cette adresse email.
                        </div>
                        <div class="alert alert-dismissible alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            Impossible d'envoyer l'email de récupération de compte.
                        </div>
                    </div>
                    <div class="text-right">
                        {!! Form::submit("Récupérer mon compte", ['class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>