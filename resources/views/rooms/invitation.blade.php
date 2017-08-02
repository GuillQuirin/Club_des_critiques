@extends('templates/template')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/rooms.css')}}">
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
    Salon - Titre du livre
@endsection

@section('content')
    <div id="join" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div>
            <div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['route' => 'valid_invitation', 'method' => 'post', 'class' => 'col-md-12']) }}
                <div class="modal-body">
                    <h1 id="title" class="text-center text-uppercase col-xs-10 col-sm-12"></h1>
                    <h1 id="autor" class="text-center text-uppercase col-xs-10 col-sm-12 autor"></h1>
                    <div class="text-center" id="div_note">
                        <h3>Donnez une note !</h3>
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
                <div class="modal-footer text-center">
                    <button type="submit" class="btn btn-success btn-lg">Valider l'invitation</button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
