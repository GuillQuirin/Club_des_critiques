<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>

		{!! Html::style('https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css') !!}
		{!! Html::style('https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css') !!}
		<!--[if lt IE 9]>
			{{ Html::style('https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js') }}
			{{ Html::style('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}
		<![endif]-->

        <!-- Styles -->
        {!! HTML::style('css/template.css'); !!}
        @yield('css')

	</head>
	<body>
		<header>
            <img src="#" alt="#">
            <a href="#">Accueil</a>
            <a href="#">Contenus</a>
            <a href="#">Salons</a>
            <a href="#">Administration</a>
            <a href="#">Mon compte / Se connecter</a>
        </header>
		
        @yield('content')
		
        <footer>
            <a href="#">Footer</a>
        </footer>
	</body>
</html>
