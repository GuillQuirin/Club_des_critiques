@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/user.css')}}">    
@endsection

@section('title')
    NOM Prenom
@endsection

@section('content')
    
    <h1>Profil Utilisateur</h1>

    <div>
        <img src="#" alt='#'>
        <p><span>NOM</span><span>PRENOM</span></p>
        <p>Email</p>
        <p>Description</p>
    </div>
    
    <div>
        <h3>Pour échanger</h3>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    
    <div>
        <h3>Contacter NOM Prenom</h3>
    </div>
@endsection