@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/products.css')}}">    
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/grid.js')}}"></script>
@endsection

@section('title')
    Liste des {{$infoCategory->name}}s
@endsection

@section('content')
    <div class="container">
    
        <h1 class="text-center">Liste des {{$infoCategory->name}}s</h1>
        
        <div class="row" id="searchElement">
            {{--
                <p>Date de publication : </p>
                <select name="order">
                    <option value="1" selected>Plus récent</option>
                    <option value="0">Plus ancien</option>
                </select>
             --}}

            {!! Form::select('id_category', 
                        [null=>'Liste des catégories de '.$infoCategory->name]+$listSubCategory, 
                        null, 
                        ['class' => 'col-xs-10 col-xs-offset-1 
                                    col-sm-4 col-sm-offset-1 
                                    col-md-3 col-md-offset-1']) !!}

            <input type="text" name="name" placeholder="Saisissez le nom de l'oeuvre"
                    class="text-center 
                        col-xs-10 col-xs-offset-1 
                        col-sm-4 col-sm-offset-2
                        col-md-3 col-md-offset-1">

            <input type="text" name="creator" placeholder="Saisissez le nom de l'auteur"
                    class="text-center 
                        col-xs-10 col-xs-offset-1 
                        col-sm-4 col-sm-offset-2
                        col-md-3 col-md-offset-1">


            <button data-route="{{route('bring_elements')}}" class="btn  col-xs-10 col-xs-offset-1 
                                                                    col-sm-4 col-sm-offset-4
                                                                    col-md-3 col-md-offset-1">Rechercher</button> 
        </div>

        <hr>
    
        @include('templates.mosaique')
        
        <div class="row text-center">
            <ul class="pagination">
            <?php 
                for($i=0;$i<count($grid)/12;$i++){
                    echo ($i==0) ? "<li class='active'>" : "<li>";
                    echo "<a>".($i+1)."</a></li>";
                }
            ?>
            </ul>
        </div>
    </div>

@endsection