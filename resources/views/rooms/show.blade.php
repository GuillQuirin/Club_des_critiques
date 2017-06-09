@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/rooms.css')}}">
@endsection

@section('title')
    Salon - Titre du livre
@endsection

@section('content')
		<div class="row">
            <h1 class="text-center col-xs-10 col-xs-offset-1 col-sm-10 text-uppercase">{{$header->name}}
                <small>Du {{date("d/m/Y", strtotime($header->date_start))}} au {{date("d/m/Y", strtotime($header->date_end))}}</small>
            </h1>
			<input type="hidden" value="{{$header->id}}" id="room"/>
            <div class="col-sm-3 col-sm-offset-1">
                <img src="http://iut.univ-amu.fr/sites/iut.univ-amu.fr/files/departement/1472852001.jpg"
                     class="valig-center col-xs-12 col-sm-12">
            </div>
            <div class="col-sm-7">
                <div class="panel-group">
                    <div class="panel panel-color panel-border">
                        <div class="panel-heading">
							<span class="glyphicon glyphicon-info-sign"></span> Informations
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-6">
                                <p>Type d'oeuvre : {{ $cat->name }}</p>
                                <p>Titre : {{$element->name}}</p>
                                <p>Auteur : {{$element->creator}}</p>
                                <p>Date de parution : {{date("d/m/Y", strtotime($element->date_publication))}}</p>
                            </div>
                            <div class="col-sm-6">
                                <p>Votre note : {{$mark->mark}}</p>
								<?php $sum = 0;?>
								@foreach ($global_mark as $marks)
									{{ $marks->mark }}
									{{ $sum = $sum + $marks->mark }}
								@endforeach
                                <p>Note globale des lecteurs : {{$sum/($global_mark->count())}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-color panel-border">
                        <div class="panel-heading">
							<span class="glyphicon glyphicon-book"></span> Synopsis
                        </div>
                        <div class="panel-body">
							{{$element->description}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="text-center text-uppercase col-sm-12">Participez au chat ! <small></small></h1>
        <div class="row">
        	<div class="col-md-6 col-sm-offset-1">
	        	<div class="col-xs-12 col-md-12">
		            <div class="panel panel-primary">
		                <div class="panel-heading">
		                    <span class="glyphicon glyphicon-comment"></span> Commentaires
		                    <div class="btn-group pull-right">
		                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
		                            <span class="glyphicon glyphicon-chevron-down"></span>
		                        </button>
		                        <ul class="dropdown-menu slidedown">
		                            <li><a href="#"><span class="glyphicon glyphicon-refresh">
		                            </span>Rafraîchir</a></li>
		                        </ul>
		                    </div>
		                </div>
		                <div class="panel-body body-panel" id="messages">
		                    <ul class="chat">
                                @foreach($chatbox as $chat)
		                        <li class="left clearfix"><span class="chat-img pull-left">
                                    @if($chat->sender->picture)
		                                <img src="{{$chat->sender->picture}}" alt="User Avatar" class="img-circle favicon_user"/>
                                    @else
                                        <img src="/images/user.png" alt="User Avatar" class="img-circle favicon_user"/>
                                    @endif
		                        </span>
		                            <div class="chat-body clearfix">
		                                <div class="header">
		                                    <strong class="primary-font">{{$chat->sender->first_name}} {{$chat->sender->last_name}}</strong> <small class="pull-right text-muted">
		                                        <span class="glyphicon glyphicon-time"></span>{{date("d/m/Y H:i:s", strtotime($chat->date_post))}}</small>
		                                </div>
		                                <p>
		                                    {{$chat->message}}
		                                </p>
		                            </div>
		                        </li>
                                @endforeach
		                    </ul>
		                </div>
		                <div class="panel-footer clearfix">
		                    <textarea class="form-control" name="message" id="message" rows="3"></textarea>
		                    <span class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-xs-12" style="margin-top: 10px">
		                        <button class="btn btn-warning btn-lg btn-block" id="send" name="send">Envoyer le message</button>
		                    </span>
		                </div>
		            </div>
		        </div>
		    </div>
        	<div class="col-md-4">
        		<div class="col-xs-12 col-sm-12">
		            <div class="panel panel-primary">
		                <div class="panel-heading">
		                    <span class="glyphicon glyphicon-user"></span> Membres du salon
		                    <div class="btn-group pull-right">
		                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
		                            <span class="glyphicon glyphicon-chevron-down"></span>
		                        </button>
		                        <ul class="dropdown-menu slidedown">
		                            <li><a href="#"><span class="glyphicon glyphicon-refresh">
		                            </span>Rafraîchir</a></li>
		                        </ul>
		                    </div>
		                </div>
		                <div class="panel-body body-panel">
		                    <ul class="chat">
                                @foreach($users as $user)
                                    @foreach($user as $u)
                                        <li class="clearfix">
                                            <div class="chat-body clearfix">
                                                <div class="col-xs-6 text-left padding-top-strong">
                                                    <strong class="primary-font">{{$u->first_name}} {{$u->last_name}}</strong>
                                                </div>
                                                <div class="col-xs-6 text-right">
                                                    <a href="{{ route('show_user', ['id' => $u->id] )}}" class="btn btn-warning" id="btn-chat">Consulter le profil</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endforeach
		                    </ul>
		                </div>
		        	</div>
					<h2 class="text-center">Invitez vos amis à rejoindre ce salon !</h2>
                    <div class="input-group input-group-lg">
                        <input type="text" name="autocomplete_user" id="autocomplete_user" class="form-control" placeholder="Saisissez le prénom de votre ami ?">
                        <span class="input-group-btn">
                        <button class="btn btn-success" type="button">Inviter !</button>
                        </span>
                    </div>
                </div>
		    </div>
		</div>
		<!--Modal ajout utilisateur-->
		<div id="addUser" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Ajout d'un membre au salon 1</h4>
					</div>
					<div class="modal-body">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-dismiss="modal">Valider</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
					</div>
				</div>
			</div>
		</div>
@endsection
