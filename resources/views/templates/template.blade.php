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
                  
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Accueil<span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Contenus</a></li>
                    <li class="dropdown">
                        <a  href="#" 
                            class="dropdown-toggle" 
                            data-toggle="dropdown" 
                            role="button" 
                            aria-haspopup="true" 
                            aria-expanded="false">Salons <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <li><a href="/livres">Livres</a></li>
                            <li><a href="/films">Films</a></li>
                            <li><a href="/expositions">Expositions</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/salons">Tous les salons</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                  </ul>

                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Administration</a></li>
                    <li class="dropdown">
                        <a  href="#" 
                            class="dropdown-toggle" 
                            data-toggle="dropdown" 
                            role="button" 
                            aria-haspopup="true" 
                            aria-expanded="false">Mon compte / Se connecter <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <li></li>
                            <li><a href="/utilisateur">Another action <span class="badge">42</span></a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container -->
            </nav>
        </header>
		
        <!-- FIL D'ARIANE -->
        <div class="container">
            <ol class="breadcrumb">
              <li><a href="#">Un </a></li>
              <li><a href="#">fil</a></li>
              <li class="active">d'ariane</li>
            </ol>
        </div>
                    
        @yield('content')

        <footer>
            <a href="#">Footer</a>
        </footer>
       
        <!-- JAVASCRIPT -->
            {!! HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js') !!}
            {!! HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') !!}
	</body>
</html>
