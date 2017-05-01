<div id="password" role="tabpanel" class="tab-pane fade">
    {!! Form::open(['url' => '/']) !!}
    <div class="modal-body">
          <div class="form-group">
            {!! Form::label('pwdUpdate','Mot de passe actuel') !!}
            {!! Form::password('pwd', [ 'id' => 'pwdUpdate', 
                                        'class' => 'form-control', 
                                        'required' => 'true']) !!}
            {!! $errors->first('pwdUpdate', '<small class="help-block">:message</small>') !!}
          </div>
          <div class="form-group">
            {!! Form::label('new_pwdUpdate','Nouveau mot de passe') !!}
            {!! Form::password('new_pwd', [ 'id' => 'new_pwdUpdate',
                                            'class' => 'form-control', 
                                            'required' => 'true']) !!}
            {!! $errors->first('new_pwdUpdate', '<small class="help-block">:message</small>') !!}
          </div>
          <div class="form-group">
            {!! Form::label('new_pwd_confirmUpdate','Confirmation du nouveau mot de passe') !!}
            {!! Form::password('new_pwd_confirm',['id' => 'new_pwd_confirmUpdate',
                                                  'class' => 'form-control', 
                                                  'required' => 'true']) !!}
            {!! $errors->first('new_pwd_confirmUpdate', '<small class="help-block">:message</small>') !!}
          </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      {!! Form::submit("Modifier le mot de passe", ['class' => 'btn btn-success pull-right']) !!}
    </div>
    {!! Form::close() !!}
</div>