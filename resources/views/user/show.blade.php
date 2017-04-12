@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/user.css')}}">    
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/user.js')}}"></script>
@endsection

@section('title')
    NOM Prenom
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center col-xs-10 col-xs-offset-1 col-sm-12">NOM PRENOM<small>Administrateur (Ile-de-France)</small></h1>

        <div class="row">
            <!-- Aucun espace entre l'image et la description afin que le vertical-align soit pris en compte -->
            <img src="/uploads/id.jpg" 
                alt='Photo de profil' 
                id="profilPicture" 
                class="valig-center col-xs-12 col-sm-4 col-md-4"><!-- --><p class="description valig-center col-xs-12 col-sm-8 col-md-8">
               Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.
            </p>
        </div>
        
        <a href="" title="Parametrer mon compte" data-toggle="modal" data-target="#edit">
            <button class="btn editProfile">
                <span class="hidden-xs">Modifier</span>
                <i class="fa fa-cog" aria-hidden="true"></i>
            </button>
        </a>

        <hr>

        <h3>Pour échanger</h3>
        <div class="row">
            <?php for($i=0; $i<4; $i++): ?>
                <div class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail">
                        <figure>
                            <img src="/images/oeuvre.jpg" alt="...">
                            <figcaption>
                                <p class="title">Titre</p>
                                <p class="author">Auteur</p>
                            </figcaption>
                        </figure>
                    </a>
                </div>
            <?php endfor; ?>
        </div>
        
        <hr>

        <h3>Contacter NOM Prenom</h3>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

               {!! Form::open(['url' => '']) !!}

                <div class="form-group">
                    {!! Form::label('Nom') !!}
                    {!! Form::text('name', null, 
                        array('required', 
                              'class'=>'form-control', 
                              'placeholder'=>'Inscrivez ici vos noms et prénoms')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Email') !!}
                    {!! Form::text('email', null, 
                        array('required', 
                              'class'=>'form-control', 
                              'placeholder'=>'Inscrivez ici votre adresse email')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Sujet du message') !!}
                    {!! Form::text('message', null, 
                        array('required', 
                              'class'=>'form-control', 
                              'placeholder'=>'Rédigez ici votre objet')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Votre message') !!}
                    {!! Form::textarea('message', null, 
                        array('required', 
                              'class'=>'form-control',
                              'size' => '30x5', 
                              'placeholder'=>'Rédigez ici votre message')) !!}
                </div>

                <div class="form-group text-right">
                    {!! Form::submit('Envoyer', 
                      array('class'=>'btn btn-primary')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div> <!-- /.Container -->

    <!-- POP-UP CONFIG COMPTE -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <ul id="popUpEdit" class="nav nav-pills" role="tablist">
              <li role="informations" class="active">
                <a href="#informations" aria-controls="informations" role="tab" data-toggle="tab">Informations</a>
              </li>
              <li role="exchange">
                <a href="#exchange" aria-controls="exchange" role="tab" data-toggle="tab">Echanges</a>
              </li>
              <li role="password">
                <a href="#password" aria-controls="password" role="tab" data-toggle="tab">Mot de passe</a>
              </li>
              <li role="delete">
                <a href="#delete" aria-controls="delete" role="tab" data-toggle="tab">Suppression</a>
              </li>
            </ul>
          </div>
          
          <div class="tab-content">
              <!-- Modification des informations générales -->
              <div id="informations" role="tabpanel" class="tab-pane fade in active">
                    {!! Form::open(['url' => '/']) !!}
                    <div class="modal-body row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <p>Nom :</p>
                            <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                {!! Form::text('email','', ['class' => 'form-control']) !!}
                                {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <p>Prénom :</p>
                            <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                {!! Form::text('email','', ['class' => 'form-control']) !!}
                                {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <p>Adresse email :</p>
                            <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                {!! Form::text('email','', ['class' => 'form-control']) !!}
                                {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <p>Région :</p>
                            <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                {!! Form::text('email','', ['class' => 'form-control']) !!}
                                {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <p>Joignable par email :</p>
                            <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                {!! Form::text('email','', ['class' => 'form-control']) !!}
                                {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <p>Image de profil :</p>
                            <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                {!! Form::text('email','', ['class' => 'form-control']) !!}
                                {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p>Description :</p>
                            <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                {!! Form::textarea('email','', 
                                      ['class' => 'form-control', 'size' => '30x5', ]) !!}
                                {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    {!! Form::submit("Mettre à jour", ['class' => 'btn btn-success pull-right']) !!}
                  </div>
                  {!! Form::close() !!}
              </div>
              
              <!-- Modification du mot de passe -->
              <div id="exchange" role="tabpanel" class="tab-pane fade">
                  {!! Form::open(['url' => '/']) !!}
                  <div class="modal-body">
                        
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    {!! Form::submit("Modifier", ['class' => 'btn btn-success pull-right']) !!}
                  </div>
                  {!! Form::close() !!}
              </div>

              <!-- Modification du mot de passe -->
              <div id="password" role="tabpanel" class="tab-pane fade">
                  {!! Form::open(['url' => '/']) !!}
                  <div class="modal-body">
                        <p>Mot de passe actuel :</p>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {!! Form::text('email','', ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                        <p>Nouveau mot de passe :</p>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {!! Form::text('email','', ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                        <p>Confirmation du nouveau mot de passe :</p>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {!! Form::text('email','', ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    {!! Form::submit("Modifier le mot de passe", ['class' => 'btn btn-success pull-right']) !!}
                  </div>
                  {!! Form::close() !!}
              </div>

              <!-- Suppression du compte-->    
              <div id="delete" role="tabpanel" class="tab-pane fade">
                  {!! Form::open(['url' => '/']) !!}
                  <div class="modal-body">
                        <p>Mot de passe actuel :</p>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {!! Form::text('email','', ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                        <p>Recopiez cette phrase dans le champ "Je souhaite supprimer mon compte" :</p>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {!! Form::text('email','', ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    {!! Form::submit("Confirmer la suppression", ['class' => 'btn btn-danger pull-right']) !!}
                  </div>
                  {!! Form::close() !!}
              </div>
          </div>
        </div>
      </div>
    </div>
@endsection