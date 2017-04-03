@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/welcome.css')}}">    
@endsection

@section('title')
    Club des critiques
@endsection

@section('content')
    
    <div class="jumbotron">
      <div class="container">
        <h1>Le club des critiques <br><small>Lisez, rencontrez, partagez</small></h1>
      </div>
    </div>
    <div class="container">       
        <div>
            <h2>Le concept</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
        </div>
    
        <hr>

        <div class="row">
            <h2>A la une</h2>
            <?php for($i=0; $i<6; $i++): ?>
                <div class="col-xs-6 col-md-4">
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

        <div>
            <h2>Nous contacter</h2>
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
@endsection