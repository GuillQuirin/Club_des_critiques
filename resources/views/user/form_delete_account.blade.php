<div id="delete" role="tabpanel" class="tab-pane fade">
    {!! Form::open(['url' => 'deleteAccount']) !!}
    <div class="modal-body">
        <div class="form-group">
          {!! Form::label('pwd_unsubUpdate','Mot de passe actuel') !!}
          {!! Form::password('pwd_unsub',[  'id' => 'pwd_unsubUpdate',
                                            'class' => 'form-control',
                                            'required' => 'true']) !!}
          {!! $errors->first('pwd_unsubUpdate', '<small class="help-block">:message</small>') !!}
        </div>
        <div class="form-group">
          {!! Form::label('confirm_unsubUpdate','Recopiez cette phrase dans le champ "Je souhaite supprimer mon compte"') !!}
          {!! Form::text('confirm_unsub','',[ 'id' => 'confirm_unsubUpdate', 
                                              'class' => 'form-control', 
                                              'required' => 'true',
                                              'pattern' => 'Je souhaite supprimer mon compte']) !!}
          {!! $errors->first('confirm_unsubUpdate', '<small class="help-block">:message</small>') !!}
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      {!! Form::submit("Confirmer la suppression", ['class' => 'btn btn-danger pull-right']) !!}
    </div>
    {!! Form::close() !!}
</div>