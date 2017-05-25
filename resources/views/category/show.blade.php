@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/products.css')}}">    
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/category.js')}}"></script>
@endsection

@section('title')
    Liste des {{$infoCategory->name}}s
@endsection

@section('content')
    <div class="container">
    
        <h1 class="text-center">Liste des {{$infoCategory->name}}s</h1>
        
        <div class="row">
            <div>
                <p>Date de publication : </p>
                <select name="order">
                    <option value="1" selected>Plus récent</option>
                    <option value="0">Plus ancien</option>
                </select>
            </div>

            <div>
                <p>Sous-catégorie : </p>
                <select name="category">
                    <option value="0" selected>Tous les {{$infoCategory->name}}s</option>

                    @foreach($listSubCategory as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr>
    
        @include('templates.mosaique')
        
        <div class="row text-center">
            <ul class="pagination">
                <li class="active"><a href="#">1</a></li>
                
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
            </ul>
        </div>
    </div>

@endsection