<div id="informations" role="tabpanel" class="tab-pane fade in active">
    {!! Form::model($infos, ['method' => 'PATCH','files'=> true ,'route' => ['update_user', $infos->id]]) !!}
    <div class="modal-body row">
         <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('firstNameUpdate','Prénom *') !!}
              {!! Form::text('first_name', $infos->first_name,[ 'id' => 'firstNameUpdate',
                                                                'class' => 'form-control',
                                                                'required' => 'required']) !!}
              {!! $errors->first('firstNameUpdate', '<small class="help-block">:message</small>') !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('lastNameUpdate','Nom *') !!}
              {!! Form::text('last_name', $infos->last_name,[ 'id' => 'lastNameUpdate',
                                                              'class' => 'form-control',
                                                              'required' => 'required']) !!}
              {!! $errors->first('lastNameUpdate', '<small class="help-block">:message</small>') !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('emailUpdate','Adresse email *') !!}
              {!! Form::email('email', $infos->email, ['id'=>'emailUpdate',
                                                        'class' => 'form-control',
                                                        'required' => 'required']) !!}
              {!! $errors->first('emailUpdate', '<small class="help-block">:message</small>') !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('isContactable','Joignable par email') !!}
              {!! Form::checkbox('is_contactable', '1', $infos->is_contactable,['id' => 'isContactable','class' => 'form-control']) !!}
              {!! $errors->first('isContactable', '<small class="help-block">:message</small>') !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('pictureInfo','Image de profil') !!}
              {!! Form::file('picture', ['id' => 'pictureInfo']) !!}
              {!! $errors->first('pictureInfo', '<small class="help-block">:message</small>') !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('locationInfo','Localisation') !!}
              {!! Form::select('id_department',$department, $infos->department_code,['id' => 'locationInfo']) !!}
              {!! $errors->first('locationInfo', '<small class="help-block">:message</small>') !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('descriptionInfo','Description') !!}
                {!! Form::textarea('description', $infos->description,[ 'id' => 'descriptionInfo',
                                                                        'class' => 'form-control', 
                                                                        'size' => '30x5', ]) !!}
                {!! $errors->first('descriptionInfo', '<small class="help-block">:message</small>') !!}
            </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      {!! Form::submit("Mettre à jour", ['class' => 'btn btn-success pull-right']) !!}
    </div>
    {!! Form::close() !!}
</div>