@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/products.css')}}">    
@endsection

@section('title')
    Liste des films
@endsection

@section('content')
    
    <h1>Liste des livres</h1>
    
    <div>
        <div>
            <p>Catégorie : </p>
            <select>
            </select>
        </div>

        <div>
            <p>Sous-catégorie : </p>
            <select>
            </select>
        </div>
    </div>

    <div>
        <!-- Mosaique des oeuvres -->
    </div>

@endsection