<div id="informations" role="tabpanel" class="tab-pane fade in active">
    {!! Form::model($infos, ['method' => 'PATCH','files'=> true ,'route' => ['update_user', $infos->id]]) !!}
    <div class="modal-body">
      <div class="row">
         <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('firstNameUpdate','Prénom *') !!}
              {!! Form::text('first_name', $infos->first_name,[ 'id' => 'firstNameUpdate',
                                                                'class' => 'form-control',
                                                                'required' => 'required']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('lastNameUpdate','Nom *') !!}
              {!! Form::text('last_name', $infos->last_name,[ 'id' => 'lastNameUpdate',
                                                              'class' => 'form-control',
                                                              'required' => 'required']) !!}
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('emailUpdate','Adresse email *') !!}
              {!! Form::email('email', $infos->email, ['id'=>'emailUpdate',
                                                        'class' => 'form-control',
                                                        'required' => 'required']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('locationInfo','Localisation') !!}
              {!! Form::select('id_department',$department, $infos->department_code,['id' => 'locationInfo',
                                                                                      'class' => 'form-control']) !!}
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('isContactable','Booktuber') !!}
              {!! Form::text('external', $infos->external,[ 'id' => 'booktuber',
                                                                        'class' => 'form-control',
                                                                        'placeholder' => 'Profil Youtube']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('isContactable','Joignable par email par les autres utilisateurs') !!}
              {!! Form::checkbox('is_contactable', '1', $infos->is_contactable,['id' => 'isContactable','class' => 'form-control']) !!}
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              {!! Form::label('pictureInfo','Image de profil') !!}
              {!! Form::file('picture', ['id' => 'pictureInfo']) !!}
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('descriptionInfo','Description') !!}
                {!! Form::textarea('description', $infos->description,[ 'id' => 'descriptionInfo',
                                                                        'class' => 'form-control', 
                                                                        'size' => '30x5', ]) !!}
            </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      {!! Form::submit("Mettre à jour", ['class' => 'btn btn-success pull-right']) !!}
    </div>
    {!! Form::close() !!}
</div>