@extends('template')

@section('titre')
	Formulaire de contact
@endsection

@section('contenu')
    <br>
	<div class="col-sm-offset-3 col-sm-6">
		<div class="panel panel-info">
			<div class="panel-heading">Contactez-moi</div>
			<div class="panel-body"> 
				{!! Form::open(['url' => 'contact']) !!}
					<!--Nom-->
					<div class="form-group {!! $errors->has('nom') ? 'has-error' : '' !!}">
						{!! Form::text('nom', null, ['class' => 'form-control', 'placeholder' => 'Votre nom']) !!}

						{{--Gestion du message d'erreur ci-dessous--}}
						{!! $errors->first('nom', '<small class="help-block">:message</small>') !!}
					</div>

					<!--Email-->
					<div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
						{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Votre email']) !!}

						{{--Gestion du message d'erreur ci-dessous--}}
						{!! $errors->first('email', '<small class="help-block">:message</small>') !!}
					</div>

					<!--Message-->
					<div class="form-group {!! $errors->has('texte') ? 'has-error' : '' !!}">
						{!! Form::textarea ('texte', null, ['class' => 'form-control', 'placeholder' => 'Votre message']) !!}

						{{--Gestion du message d'erreur ci-dessous--}}
						{!! $errors->first('texte', '<small class="help-block">:message</small>') !!}
					</div>

					{!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
				
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection