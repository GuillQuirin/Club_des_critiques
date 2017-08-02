@extends('templates/template')

@section('css')
     {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/user.css')}}">   --}}  
@endsection

@section('js')
    {{-- <script type="text/javascript" src="{{asset('js/editUser.js')}}"></script> --}}
@endsection

@section('title')
  Erreur 404
@endsection


@section('content')
	<br><br>
	<div class="row">
	    <div class="col-sm-offset-4 col-sm-4">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<h3 class="panel-title">Il y a un problème !</h3>
				</div>
				<div class="panel-body"> 
					<p>Nous sommes désolés mais la page que vous désirez n'existe pas...</p>
				</div>
			</div>
		</div>
	</div>
@endsection