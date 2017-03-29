@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/products.css')}}">    
@endsection

@section('title')
    Liste des livres
@endsection

@section('content')
    
    <h1>Liste des livres</h1>
    
    <div>
        <div>
            <p>Catégorie : </p>
            <select>
                <option>Romans</option>
                <option>Bande-dessinée</option>
            </select>
        </div>

        <div>
            <p>Sous-catégorie : </p>
            <select>
                <option>Policier</option>
                <option>Science-fiction</option>
            </select>
        </div>
    </div>

    <div>
        <!-- Mosaique des oeuvres -->
    </div>

@endsection