@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/welcome.css')}}">  
     <style type="text/css">
         .jumbotron{background-image: url({{$page['url_background']}});}
     </style>  
@endsection

@section('title')
    {{$page['title']}}
@endsection

@section('content')
    
    <div class="jumbotron">
      <div class="container-fluid">
        <h1>{{$page['title']}} <br><small>{{$page['slogan']}}</small></h1>
      </div>
    </div>
    <div class="container notPadding">       
        <div>
            <h2>Le concept</h2>
            <p>{{$page['description']}}</p>
        </div>
    
        <hr>

        @include('templates.mosaique')
        
        <hr>

        <div>
            <h2>Nous contacter</h2>

           {!! Form::open(['url' => 'contactAdmin', 'class' => 'notRedirect', 'id' => 'formContact']) !!}
            <div class="form-group">
                {!! Form::label('nameContact','Nom') !!}
                {!! Form::text('name', null, 
                    array('id' => 'nameContact', 
                          'required' => 'true', 
                          'class'=>'form-control', 
                          'placeholder'=>'Inscrivez ici vos noms et prénoms')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('emailContact','Email') !!}
                {!! Form::email('email', null, 
                    array('id' => 'emailContact', 
                          'required' => 'true', 
                          'class'=>'form-control', 
                          'placeholder'=>'Inscrivez ici votre adresse email')) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('objectContact','Sujet du message') !!}
                {!! Form::text('object', null, 
                    array('id' => 'objectContact', 
                          'required' => 'true', 
                          'class'=>'form-control', 
                          'placeholder'=>'Indiquez un objet')) !!}
            </div>
  
            <div class="form-group">
                {!! Form::label('messageContact','Votre message') !!}
                {!! Form::textarea('message', null, 
                    array('id' => 'messageContact', 
                          'required' => 'true', 
                          'class'=>'form-control', 
                          'placeholder'=>'Rédigez ici votre message')) !!}
            </div>

            <div class="form-group text-right">
                {!! Form::submit('Envoyer', 
                  array('class'=>'btn btn-primary')) !!}
            </div>

            <div class="alert alert-dismissible alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Le message vient d'être envoyé aux administrateurs.
            </div>
            <div class="alert alert-dismissible alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{--Vous avez excédé le nombre d'envoi autorisé, merci de patienter un instant.--}}
                Veuillez remplir tous les champs.
            </div>
            <div class="alert alert-dismissible alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Le message n'a pas pu être envoyé.
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection