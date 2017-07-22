@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/products.css')}}">    
@endsection

@section('title')
    Liste des {{$infoCategory->name}}s
@endsection

@section('content')
    <div class="container">
    
        <h1 class="text-center">Liste des {{$infoCategory->name}}s</h1>
        
        <div class="row" id="searchElement">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1">
                    {!! Form::select('id_category', 
                        [$infoCategory->id=>'Sous-catégories de '.$infoCategory->name.' :']+$listSubCategory, 
                        null, 
                        ['class' => 'verti_marg form-control']) !!}
                </div>
                <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-2">
                    {!! Form::select('order', 
                        [null=>'Trier par date', 'Plus récent', 'Plus ancien'], 
                        null, 
                        ['class' => ' verti_marg form-control']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1">
                    <input type="text" name="name" placeholder="Nom d'une oeuvre" class="text-center verti_marg form-control">
                </div>
                <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-2">
                    <input type="text" name="creator" placeholder="Nom d'un auteur" class="text-center verti_marg form-control">
                </div>
            </div>
            <s></s>
            <button data-route="{{route('bring_elements')}}" class="btn verti_marg col-xs-10 col-xs-offset-1 
                                                                    col-sm-4 col-sm-offset-4
                                                                    col-md-4 col-md-offset-4">Rechercher</button> 
        </div>

        <hr>
    
        @include('templates.mosaique')
        
    </div>

@endsection