@extends('templates/template')

{{-- @section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/users.css')}}">    
@endsection --}}


@section('title')
    Liste des utilisateurs
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center">Notre communauté</h1>

        <div class="row">
            {{-- <p class="description text-center col-md-12">
               Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.
            </p> --}}
        </div>
        
        <hr>
    
        <div class="row" id="searchElement">
            {!! Form::select('id_department', 
                            [null=>'Choisissez un département']+$departments, 
                            null, 
                            ['class' => 'col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-3 col-md-offset-1']) !!}

            <input type="text" name="first_name" placeholder="Saisissez un prénom" 
                    class="text-center 
                            col-xs-10 col-xs-offset-1 
                            col-sm-4 col-sm-offset-2
                            col-md-3 col-md-offset-1">

            <button data-route="{{route('bring_users')}}" 
                    class="btn  col-xs-10 col-xs-offset-1 
                                col-sm-4 col-sm-offset-4
                                col-md-3 col-md-offset-1"
                    @if(isset($redirection))
                        data-redirect="{{ route($redirection,[ 'id' => NULL ]) }}"
                    @endif>Rechercher</button>
        </div>

        <hr>

        @include('templates.mosaique')

    </div>
@endsection