@extends('templates/template')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/rooms.css')}}">
    <style>
        .rating{
            display: inline-block;
            width: inherit; 
            margin-left: inherit;
        }
    </style>
@endsection

@section('js')
    <script>
        $('.rating').children('a').each(function(){
            $(this).click(function(){
                document.getElementById('note').value = this.getAttribute("href").substring(1);
            })
        })
        </script>
@endsection

@section('title')
    Rejoindre un salon
@endsection

@section('content')
    <div class="container">
        <div id="join" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div>
                {{ Form::open(['route' => 'valid_invitation', 'method' => 'post', 'class' => 'col-md-12']) }}
                <div class="modal-body">
                    <div class="text-center">
                        <h3>Avant d'être inscrit au salon, nous vous invitons à donner une note à l'oeuvre ciblée !</h3>
                        <div class="rating">
                            <a href="#4" title="Donner 4 étoiles">☆</a>
                            <a href="#3" title="Donner 3 étoiles">☆</a>
                            <a href="#2" title="Donner 2 étoiles">☆</a>
                            <a href="#1" title="Donner 1 étoile">☆</a>
                        </div>
                    </div>
                    <?php 
                        if(isset($_GET['room']) && intval($_GET['room'])):
                    ?>
                        <input type="hidden" id="room" name="room" value="<?php echo $_GET['room']; ?>"/>
                    <?php
                        endif; 
                    ?>
                    <input type="hidden" id="note" name="note"/>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">Valider l'invitation</button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
