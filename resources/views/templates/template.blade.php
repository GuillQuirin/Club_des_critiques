<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>
    
        <!-- CSS -->
    		{!! Html::style('https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!}
    		{!! Html::style('https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css') !!}
    		<!--[if lt IE 9]>
    			{{ Html::style('https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js') }}
    			{{ Html::style('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}
    		<![endif]-->
            {!! HTML::style('css/template.css'); !!}
            @yield('css')
	</head>
	<body>
		<header>
            <nav class="navbar navbar-default navbar-fixed-top">
              <div class="container">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" 
                            class="navbar-toggle collapsed" 
                            data-toggle="collapse" 
                            data-target="#bs-example-navbar-collapse-1" 
                            aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="/"><img src="#" alt="#"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                 <div id="sidebar-wrapper"> 
                  <ul class="nav navbar-nav" class="sidebar-nav">
                    <li class="visible-xs-block"><a href="{{ route('home') }}"><img class="logo" src="/images/logo.png" alt="logo"></a></li>
                    <li class="active hidden-sm"><a href="{{ route('home') }}">Accueil<span class="sr-only">(current)</span></a></li>
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
                            <li><a href="{{ route('search_element') }}">Rechercher une oeuvre</a></li>
                        </ul>
                    </li>
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
<!-- A décommenter -->
                            <!-- <a href="{{ route('show_room', ['id' => 1]) }}">Accèdez à la fiche du salon</a> -->
                            <a href=''>Accèdez à la fiche du salon</a>
                        </div>
                    </li>
                  </ul>

                  <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a  href="#" 
                            class="dropdown-toggle" 
                            data-toggle="dropdown" 
                            role="button" 
                            aria-haspopup="true" 
                            aria-expanded="false">Connexion<span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="" data-toggle="modal" data-target="#loginModal">Authentification 
                                    <span class="badge">42</span>
                                </a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="" data-toggle="modal" data-target="#registerModal">Inscription</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Administration</a></li>
                        </ul>
                    </li>
                  </ul>
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
        
        <footer>
            <a href="#">Footer</a>
        </footer>
       
      <!-- MODAL CONNEXION -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
              <div class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
    
        <!-- MODAL INSCRIPTION -->
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Rejoignez-nous</h4>
              </div>
              {!! Form::open(['url' => '/']) !!}
              <div id="popupRegister" class="modal-body">
                    <p>Adresse email :</p>
                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        {!! Form::text('email','', ['class' => 'form-control']) !!}
                        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                {!! Form::submit("S'inscrire", ['class' => 'btn btn-info pull-right']) !!}
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>

        <!-- JAVASCRIPT -->
            {!! HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js') !!}
            {!! HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') !!}
            {!! HTML::script('js/jquery.countdown.js') !!}
            <script type="text/javascript">
                $(document).ready(function(){

                    /* COUNTDOWN */
                    $('[data-countdown]').each(function() {
                      var $this = $(this), finalDate = $(this).data('countdown');
                      $this.countdown(finalDate, function(event) {
                        $this.html(event.strftime('%D jours %H:%M:%S'));
                      });
                    });

                });
            </script>
	</body>
</html>
