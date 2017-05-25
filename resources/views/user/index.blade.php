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
            <form action="" id="searchUser">
                <div class="row">
                    <div>
                        <p>Inscription : </p>
                        <select name="order">
                            <option value="1" selected>La plus récente</option>
                            <option value="0">La plus ancienne</option>
                        </select>
                    </div>

                    <input type="text" name="pnom" placeholder="Prénom" 
                            class="text-center 
                                    col-xs-8 col-xs-offset-2 
                                    col-sm-4 col-sm-offset-0
                                    col-md-4">

                    <select name="countRooms" 
                            class="text-center 
                                    col-xs-8 col-xs-offset-2 
                                    col-sm-4 col-sm-offset-0
                                    col-md-4">
                        <option>+ de participations aux salons</option>
                        <option>- de participations aux salons</option>
                    </select>
                    
                    <div class="text-center col-md-12">
                       <input type="submit" class="btn" value="Rechercher un utilisateur">
                    </div>
                </div>
            </form>
        </div>

        <hr>

        @include('templates.mosaique')
        
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