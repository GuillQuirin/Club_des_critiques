@extends('templates/template')

@section('title')
    Liste des oeuvres
@endsection

@section('content')
	 <div class="container">
    
        <h1 class="text-center">Liste des oeuvres</h1>
        
        <div class="row" id="searchElement">
            <div class="col-xs-10 col-xs-offset-1 col-sm-3 col-sm-offset-0 col-md-3 col-md-offset-0n">
                {!! Form::select('order', 
                        [null=>'Trier par date', 'Plus récent', 'Plus ancien'], 
                        null, 
                        ['class' => 'verti_marg form-control']) !!}
            </div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1">
                <input type="text" name="name" placeholder="Nom d'une oeuvre" class="text-center verti_marg form-control">
            </div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-3 col-md-offset-1">
                <input type="text" name="creator" placeholder="Nom d'un auteur" class="text-center verti_marg form-control">
            </div>
            <button data-route="{{route('bring_elements')}}" class="btn verti_marg col-xs-10 col-xs-offset-1 
                                                                    col-sm-4 col-sm-offset-4
                                                                    col-md-4 col-md-offset-4">Rechercher</button> 
        </div>

        <hr>

        @include('templates.mosaique')
        
    </div>
@endsection