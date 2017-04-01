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
        <h1>Le club des critiques</h1>
      </div>
    </div>
    <div class="container">
        <div>
            <h3>Menu flottant</h3>
            <p>Inscrivez-vous</p>
        </div>
        
        <div>
            <h3>Menu flottant</h3>
            <p>Prochain salon : </p>
        </div>
        
        <div>
            <h2>Le concept</h2>
        </div>

        <div>
            <h2>A la une</h2>
        </div>

        <div>
            <h2>Nous contacter</h2>
        </div>
    </div>
@endsection