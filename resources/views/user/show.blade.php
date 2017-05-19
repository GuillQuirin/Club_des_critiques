@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/user.css')}}">    
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/user.js')}}"></script>
@endsection

@section('title')
  @if($infos->first_name)
    {{$infos->first_name}}
  @else 
    Utilisateur-{{$infos->id}}
  @endif
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center col-xs-10 col-xs-offset-1 col-sm-12">
          @if($infos->first_name)
            {{$infos->first_name}}
          @else
            Utilisateur-{{$infos->id}}
          @endif

          <small>
            @if($infos->status==0 || $infos->status==1)
              Inscrit depuis le {{date('d/m/Y', strtotime($infos->date_created))}}
            @elseif($infos->status==1)
              Administrateur
            @elseif($infos->status==1)
              Membre banni
            @endif

            <br>{{$departements}}

           </small>
        </h1>

        <div class="row">
            <!-- Aucun espace entre l'image et la description afin que le vertical-align soit pris en compte -->
            @if($infos->picture)
              <img src="{{$infos->picture}}" 
                alt='Photo de profil' 
                id="profilPicture" 
                class="valig-center col-xs-12 col-sm-4 col-md-4">
            @else 
              <img src="/images/user.png" 
                alt='Photo de profil' 
                id="profilPicture" 
                class="valig-center col-xs-12 col-sm-4 col-md-4">
            @endif
            <!-- --><p class="description valig-center col-xs-12 col-sm-8 col-md-8">{{$infos->description}}</p>
        </div>
        
        @if($infos->myAccount)
          <!-- POP-UP CONFIG COMPTE -->
          <a href="" title="Parametrer mon compte" data-toggle="modal" data-target="#edit">
              <button class="btn editProfile">
                  <span class="hidden-xs">Modifier</span>
                  <i class="fa fa-cog" aria-hidden="true"></i>
              </button>
          </a>
          @include('user.edit')
        @endif

        <hr>
        
        <!-- ECHANGES -->
        <h3>Propose d'échanger : </h3>
        {{-- @include('templates.mosaique') --}}
        
        <hr>
        
        <!-- FORMULAIRE DE CONTACT -->
        <h3>Contacter {{$infos->first_name}}</h3>
        <div class="row">
            <div class="col-md-12">
              @if(!$infos->is_contactable)

                @if($infos->myAccount)
                  <p>Seuls les administrateurs sont autorisés à communiquer avec vous.</p>
                @else
                  <p>{{$infos->first_name}} n'est pas joignable actuellement.</p>
                @endif

              @else

                @if($infos->myAccount)
                  <p>Tous les utilisateurs inscrits peuvent vous contacter.</p>
                @elseif(!$infos->myAccount && Auth::guest())
                  <p>Vous devez vous authentifier afin de pouvoir contacter cette personne.</p>
                @elseif(!$infos->myAccount && Auth::check())
                  @include('user/form_contact_user')
                @endif
             
              @endif
            </div>
        </div>
    </div> <!-- /.Container -->    

@endsection