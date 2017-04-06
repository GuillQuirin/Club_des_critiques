@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/user.css')}}">    
@endsection

@section('title')
    NOM Prenom
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center">NOM PRENOM</h1>

        <div class="row">
            <img src="#" alt='Photo de profil' id="profilPicture" class="col-md-4">
            <p class="description col-md-8">
               Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.
            </p>
        </div>
        
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
                              'placeholder'=>'Rédigez ici votre message')) !!}
                </div>

                <div class="form-group text-right">
                    {!! Form::submit('Envoyer', 
                      array('class'=>'btn btn-primary')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection