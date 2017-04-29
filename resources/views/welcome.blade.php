@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/welcome.css')}}">  
     <style type="text/css">
         .jumbotron{background-image: url({{$array['url_background']}});}
     </style>  
@endsection

@section('title')
    {{$array['title']}}
@endsection

@section('content')
    
    <div class="jumbotron">
      <div class="container-fluid">
        <h1>{{$array['title']}} <br><small>{{$array['slogan']}}</small></h1>
      </div>
    </div>
    <div class="container notPadding">       
        <div>
            <h2>Le concept</h2>
            <p>{{$array['description']}}</p>
        </div>
    
        <hr>

        {{-- @include('templates.mosaique') --}}
        
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