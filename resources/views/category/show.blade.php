@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/products.css')}}">    
@endsection

@section('title')
    Liste des livres
@endsection

@section('content')
    
    <div class="container">
    
        <h1 class="text-center">Liste des livres</h1>
        
        <div class="row">
            <div>
                <p>Date de publication : </p>
                <select>
                    <option>Plus récent</option>
                    <option>Plus ancien</option>
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

        <hr>

        <div class="row">
        <?php for($i=0; $i<6; $i++): ?>
            <div class="col-xs-6 col-md-4">
                <a href="{{ route('show_user',[ 'id' => 1 ]) }}" class="thumbnail">
                    <figure>
                        <img src="/images/oeuvre.jpg" alt="...">
                        <figcaption>
                            <p class="title">Utilisateur<?php echo $i; ?></p>
                            <p class="author">Auteur</p>
                        </figcaption>
                    </figure>
                </a>
            </div>
        <?php endfor; ?>
        </div>
        
        <div class="row text-center">
            <ul class="pagination">
                <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
            </ul>
        </div>
    </div>

@endsection