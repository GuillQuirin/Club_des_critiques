<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-site-verification" content="TVA3m8pMDsnZVrewoidSwfikQtr8esxp1ftFD55VsSc" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>@yield('title')</title>
    
        <!-- CSS -->
        {!! Html::style('https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!}
        {!! Html::style('https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css') !!}
        {!! HTML::style('font-awesome-4.7.0/css/font-awesome.css') !!}
        {!! HTML::style('DataTables/datatables.min.css') !!}
        {!! HTML::style('bootstrap-datepicker/css/bootstrap-datepicker.min.css') !!}
        <!-- {!! HTML::style('bootstrap-select/dist/css/bootstrap-select.min.css') !!} -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
        {!! HTML::style('css/template.css') !!}
        @yield('css')
    </head>
    <body>
        <header id="wrapper">
            <nav id="page-content-wrapper" class="navbar navbar-default navbar-fixed-top">
              <div class="container-fluid">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" 
                            class="navbar-toggle collapsed" 
                            data-toggle="collapse" 
                            data-target="#bs-example-navbar-collapse-1" 
                            id="menu-toggle"
                            aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a href="/"><img class="logo" src="/images/logo.png" alt="logo"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                 <div id="sidebar-wrapper"> 
                  <ul class="nav navbar-nav" class="sidebar-nav">

                    <li class="visible-xs-block"><a href="{{ route('home') }}"><img class="logo" src="/images/logo.png" alt="logo"></a></li>
                  
                    <li class="hidden-xs hidden-sm"><a href="{{ route('home') }}">Accueil<span class="sr-only">(current)</span></a></li>

                    <hr class="visible-xs-block">

                    <li class="dropdown">
                        <a  href="#" 
                            class="dropdown-toggle" 
                            data-toggle="dropdown" 
                            role="button" 
                            aria-haspopup="true" 
                            aria-expanded="false">Oeuvres <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="{{ route('show_category', ['id' => 1]) }}">Livres</a></li>
                            <li><a href="{{ route('show_category', ['id' => 2]) }}">Films</a></li>
                            <li><a href="{{ route('show_category', ['id' => 3]) }}">Expositions</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('elements') }}">Toutes les oeuvres</a></li>
                        </ul>
                    </li>

                    <hr class="visible-xs-block">

                    <li class="dropdown">
                        <a  href="#" 
                            class="dropdown-toggle" 
                            data-toggle="dropdown" 
                            role="button" 
                            aria-haspopup="true" 
                            aria-expanded="false">Salons <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <li><a href="{{ route('futur_rooms') }}">Les salons à venir</a></li>
                            <li><a href="{{ route('my_rooms') }}">Mes salons</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('rooms') }}">Tous les salons</a></li>
                        </ul>
                    </li>
 
                    <hr class="visible-xs-block">

                    <li class="dropdown">
                        <a href="{{ route('users') }}">
                            <span class="hidden-sm">La communauté</span>
                            <i class="visible-sm-block fa fa-users" aria-hidden="true"></i>
                            </a>
                    </li>

                    <hr class="visible-xs-block">

                    <li class="dropdown dropdownCountdown">
                        <a  id="nextRoomCountdown" 
                            data-countdown="2017/07/19"
                            class="dropdown-toggle" 
                            data-toggle="dropdown" 
                            role="button" 
                            aria-haspopup="true" 
                            aria-expanded="false"></a>

                        <div id="nextRoomDetails" class="dropdown-menu">
                            <p>Prochain salon :</p>
                            <p>Oeuvre</p>
                            <p>Date de lancement:</p>
                            <a href="{{ route('show_room', ['id' => 1]) }}">Accèdez à la fiche du salon</a>
                        </div>
                    </li>
                    
                    <hr class="visible-xs-block">
                  </ul>

                  <ul class="nav navbar-nav navbar-right sidebar-nav">
                    <li class="dropdown">
                        
                        <a  href="#" 
                            class="dropdown-toggle hidden-sm" 
                            data-toggle="dropdown" 
                            role="button" 
                            aria-haspopup="true" 
                            aria-expanded="false">Connexion<span class="caret"></span></a>
                        
                        <a  href="#" 
                            class="dropdown-toggle visible-sm-block" 
                            data-toggle="dropdown" 
                            role="button" 
                            aria-haspopup="true" 
                            aria-expanded="false">
                                <i  class="fa fa-sign-in" aria-hidden="true"></i>
                                <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            @if(Auth::guest())
                                <li>
                                    <a href="" data-toggle="modal" data-target="#loginModal">Authentification 
                                        <span class="badge">42</span>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="" data-toggle="modal" data-target="#registerModal">Inscription</a>
                                </li>
                            @endif
                            
                            @if(Auth::check())
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ route('show_user', ['id' => 1]) }}">Mon compte</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="">Déconnexion</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('admin') }}">Administration</a></li>
                            @endif
                        </ul>
                    </li>
                  </ul>
                 </div>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container -->
            </nav>
            
        </header>
        
        <?php 
        //FIL D'ARIANE
        $breadcrumbs = new Creitive\Breadcrumbs\Breadcrumbs; 
        $breadcrumbs->addCrumb('Accueil', '/');
        $breadcrumbs->addCrumb('Livres', '/livres');
        //echo $breadcrumbs->render();
        ?>
        
        <!-- <div class="container">
            <ol class="breadcrumb">
              <li><a href="#">Un </a></li>
              <li><a href="#">fil</a></li>
              <li class="active">d'ariane</li>
            </ol>
        </div> -->
        
        <span id="content">
            @yield('content')
        </span>
        
        @if(!isset($_COOKIE['alert_cookies']))
            <div id="alert_cookies" class="alert alert-warning alert-dismissible fade in" role="alert"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <p>En poursuivant votre navigation sur ce site, vous acceptez l'utilisation de cookies afin d'améliorer son fonctionnement. Pour en savoir plus et paramétrer les cookies, cliquez ici.</p>
            </div>
        @endif
        <footer class="footer">
			<div class="container text-center">
				<span class="text-muted">
                        <a href="#" class="no-padding-left">Notre concept</a>
                        <a href="#">Nous contacter</a>
                        <a href="/"><img class="logo" src="/images/logo.png" alt="logo"></a>
                        <a href="{{ route('admin') }}">Administration</a>
                        <a href="#">Copyright</a>
                </span>
			</div>
		</footer>
       
        <!-- MODAL CONNEXION -->
        @include('templates.modalLogin')
    
        <!-- MODAL INSCRIPTION -->
        @include('templates.modalRegister')

        <!-- JAVASCRIPT -->
        {!! HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js') !!}
        {!! HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') !!}
        {!! HTML::script('js/jquery.countdown.js') !!}
        {!! HTML::script('DataTables/datatables.min.js') !!}
        {!! HTML::script('bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
        <!-- {!! HTML::script('bootstrap-select/dist/js/bootstrap-select.mins.js') !!} -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
        {!! HTML::script('js/template.js') !!}
        {!! HTML::script('js/autocomplete.js') !!}
        @yield('js')
    </body>
</html>
