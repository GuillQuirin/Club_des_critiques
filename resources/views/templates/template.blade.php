<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-site-verification" content="TVA3m8pMDsnZVrewoidSwfikQtr8esxp1ftFD55VsSc" />
        <title>@yield('title')</title>
    
        <!-- CSS -->
            {!! Html::style('https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!}
            {!! Html::style('https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css') !!}
            <!--[if lt IE 9]>
                {{ Html::style('https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js') }}
                {{ Html::style('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}
            <![endif]-->
            {!! HTML::style('font-awesome-4.7.0/css/font-awesome.css') !!}
            {!! HTML::style('DataTables/datatables.min.css') !!}
            {!! HTML::style('bootstrap-datepicker/css/bootstrap-datepicker.min.css') !!}
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
                            <li>
                                <a href="{{ route('show_user', ['id' => 1]) }}">Mon compte</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('admin') }}">Administration</a></li>
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
        
        <footer>
			<div class="site-footer">
				<span class="text-muted">Place sticky footer content here.</span>
			</div>
		</footer>
       
      <!-- MODAL CONNEXION -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalAuth">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalAuth">Accès à votre compte utilisateur</h4>
              </div>
              <div id="popupRegister" class="modal-body">
                <!-- Authentification -->
                {!! Form::open(['url' => '/']) !!}
                    <p>Adresse email :</p>
                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        {!! Form::text('email','', ['class' => 'form-control']) !!}
                        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                    </div>
                    <p>Mot de passe :</p>
                    <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                        {!! Form::text('password','', ['class' => 'form-control']) !!}
                        {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="row">
                        <span class="col-xs-6 col-sm-6 col-md-6 text-left">
                            <a  class="btn btn-warning" role="button" data-toggle="collapse" 
                                href="#forgetPwd" aria-expanded="false" aria-controls="forgetPwd">
                                Mot de passe oublié ?</a>
                        </span>
                        <span class="col-xs-6 col-sm-6 col-md-6 text-right">
                            {!! Form::submit("Se connecter", ['class' => 'btn btn-success']) !!}
                        </span>
                    </div>
                {!! Form::close() !!}

                <!-- Récupération de mot de passe -->
                <div class="collapse" id="forgetPwd">
                  <hr>
                  <div class="text-center">
                      <h4 class="modal-title">Récupération de votre compte</h4>
                  </div>
                  <hr>
                  {!! Form::open(['url' => '/']) !!}
                    <p>Un email vous sera envoyé à cette adresse : </p>
                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        {!! Form::text('email','', ['class' => 'form-control']) !!}
                        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="text-right">
                        {!! Form::submit("Récupérer mon compte", ['class' => 'btn btn-success']) !!}
                    </div>
                  {!! Form::close() !!}
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
              </div>
            </div>
          </div>
        </div>
    
        <!-- MODAL INSCRIPTION -->
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalRegis">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalRegis">Rejoignez-nous !</h4>
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
                {!! Form::submit("S'inscrire", ['class' => 'btn btn-success pull-right']) !!}
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>

        <!-- JAVASCRIPT -->
            {!! HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js') !!}
            {!! HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') !!}
            {!! HTML::script('js/jquery.countdown.js') !!}
            {!! HTML::script('DataTables/datatables.min.js') !!}
            {!! HTML::script('bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
            {!! HTML::script('js/template.js') !!}
            @yield('js')
    </body>
</html>
