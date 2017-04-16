@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/user.css')}}">    
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/user.js')}}"></script>
@endsection

@section('title')
    {{$infos['f_name']}}
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center col-xs-10 col-xs-offset-1 col-sm-12">{{$infos['f_name']}}
          <small>{{$infos['status']}} ({{$infos['localization']}})</small>
        </h1>

        <div class="row">
            <!-- Aucun espace entre l'image et la description afin que le vertical-align soit pris en compte -->
            <img src="{{$infos['image']}}" 
                alt='Photo de profil' 
                id="profilPicture" 
                class="valig-center col-xs-12 col-sm-4 col-md-4"><!-- --><p class="description valig-center col-xs-12 col-sm-8 col-md-8">{{$infos['description']}}</p>
        </div>
        
        @if($infos['editAccount'])
          <a href="" title="Parametrer mon compte" data-toggle="modal" data-target="#edit">
              <button class="btn editProfile">
                  <span class="hidden-xs">Modifier</span>
                  <i class="fa fa-cog" aria-hidden="true"></i>
              </button>
          </a>
        @endif

        <hr>
        
        <!-- ECHANGES -->
        <h3>Propose d'échanger : </h3>
        @include('templates.mosaique')
        
        <hr>
        
        <!-- FORMULAIRE DE CONTACT -->
        <h3>Contacter {{$infos['f_name']}}</h3>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
              @if(!$infos['is_joignable'])
                <p>{{$infos['f_name']}} n'est pas joignable actuellement.</p>
              @else
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

               {!! Form::open(['url' => '']) !!}

                <div class="form-group">
                    {!! Form::label('Nom') !!}
                    {!! Form::text('name', null, 
                        array('required', 
                              'class'=>'form-control', 
                              'placeholder'=>'Inscrivez ici votre nom et prénom')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Email') !!}
                    {!! Form::text('email', null, 
                        array('required', 
                              'class'=>'form-control', 
                              'placeholder'=>'Inscrivez ici votre adresse email')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Sujet du message') !!}
                    {!! Form::text('message', null, 
                        array('required', 
                              'class'=>'form-control', 
                              'placeholder'=>'Rédigez ici votre objet')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Votre message') !!}
                    {!! Form::textarea('message', null, 
                        array('required', 
                              'class'=>'form-control',
                              'size' => '30x5', 
                              'placeholder'=>'Rédigez ici votre message')) !!}
                </div>

                <div class="form-group text-right">
                    {!! Form::submit('Envoyer', 
                      array('class'=>'btn btn-primary')) !!}
                </div>
                {!! Form::close() !!}
              @endif
            </div>
        </div>
    </div> <!-- /.Container -->

    <!-- POP-UP CONFIG COMPTE -->
    @include('user.edit')
    

@endsection