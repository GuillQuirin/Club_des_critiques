@extends('templates/template')

@section('title')
    Récupération du mot de passe
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center">Mot de passe</h1>

        <div class="row">
{{--             <p class="description text-center col-md-12">
              Veuillez enregistrer un mot de passe suffisamment complexe 
            </p> --}}
        </div>
        
        <hr>
    
        <div class="row">
            {!! Form::open(['url' => 'checkToken','class' => 'notRedirect']) !!}
            <div>
                  @if($token)
                    {{ Form::hidden('token', $token) }}
                  @endif
                  <div class="form-group">
                    {!! Form::label('new_pwdUpdate','Nouveau mot de passe *') !!}
                    {!! Form::password('new_pwd', [ 'id' => 'new_pwdUpdate',
                                                    'class' => 'form-control', 
                                                    'required' => 'required']) !!}
                    {!! $errors->first('new_pwdUpdate', '<small class="help-block">:message</small>') !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('new_pwd_confirmUpdate','Confirmation du nouveau mot de passe *') !!}
                    {!! Form::password('new_pwd_confirm',['id' => 'new_pwd_confirmUpdate',
                                                          'class' => 'form-control', 
                                                          'required' => 'required']) !!}
                    {!! $errors->first('new_pwd_confirmUpdate', '<small class="help-block">:message</small>') !!}
                  </div>
                  <div class="alert alert-dismissible alert-danger" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      Les nouveaux mots de passe ne correspondent pas.
                  </div>
            </div>
            <div>
              {!! Form::submit("Mettre à jour le mot de passe", ['class' => 'btn btn-success pull-right']) !!}
            </div>
            {!! Form::close() !!}
        </div>

    </div>
@endsection