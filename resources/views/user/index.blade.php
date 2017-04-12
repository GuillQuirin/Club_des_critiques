@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/users.css')}}">    
@endsection

@section('title')
    Liste des utilisateurs
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center">Notre communauté</h1>

        <div class="row">
            <p class="description text-center col-md-12">
               Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.
            </p>
        </div>
        
        <hr>

        <div class="row">
        <?php for($i=0; $i<10; $i++): ?>
            <div class="col-xs-6 col-md-3">
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