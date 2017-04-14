@extends('templates/template')

@section('title')
    Oeuvres
@endsection

@section('content')
	 <div class="container">
    
        <h1 class="text-center">Liste des oeuvres</h1>
        
        <div class="row">
            <div>
                <p>Catégorie: </p>
                <select name="category">
                  @foreach ($categories as $key => $category)
                      <option value="{{ $key }}">{{ $category }}</option>
                  @endforeach
                </select>
            </div>

            <div>
                <p>Sous-catégorie : </p>
                <select>
                    @foreach ($subCategories as $key => $subCategory)
                      <option value="{{ $key }}">{{ $subCategory }}</option>
                    @endforeach
                </select>
            </div>
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