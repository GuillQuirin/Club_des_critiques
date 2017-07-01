@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/rooms.css')}}">
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/room.js')}}"></script>
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
            <div class="col-sm-3 col-sm-offset-1 col-xs-5 col-xs-offset-3">
                <img src="http://iut.univ-amu.fr/sites/iut.univ-amu.fr/files/departement/1472852001.jpg"
                     class="valig-center col-xs-12 col-sm-12">
            </div>
            <div class="col-sm-7 col-sm-offset-0 col-xs-10 col-xs-offset-1 verti_marg">
                <div class="panel-group">
                    <div class="panel panel-color panel-border">
                        <div class="panel-heading">
							<span class="glyphicon glyphicon-info-sign"></span> <h4 class="d-inline">Informations</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-6">
                                <p><strong>Titre : </strong>{{$element->name}}</p>
                                <p><strong>Auteur : </strong>{{$element->creator}}</p>
                                <p><strong>Type d'oeuvre :</strong> {{ $cat->name }}</p>
                                <p><strong>Date de parution : </strong>{{date("d/m/Y", strtotime($element->date_publication))}}</p>
                            </div>
                            <div class="col-sm-6">
                                <strong>Votre note : </strong><h1 class="d-inline">{{$mark->mark}}</h1>/4 <br>
								<?php $sum = 0;?>
								@foreach ($global_mark as $marks)
									<?php $sum = $sum + $marks->mark; ?>
								@endforeach
                                 <strong>Note globale des lecteurs : </strong><h1 class="d-inline">{{$sum/($global_mark->count())}}</h1>/4
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-color panel-border">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-book"></span> <h4 class="d-inline">Synopsis</h4>
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
                            <span class="glyphicon glyphicon-comment"></span> <h4 class="d-inline">Commentaires</h4>
		                </div>
		                <div class="panel-body body-panel" id="messages">
                            <ul id="chatbox" class="chat">
                                @foreach($chatbox as $value)
                                    <li class="left clearfix">
                                        <span class="chat-img pull-left">
                                            <img src="{{$value['picture']}}" alt="User Avatar" class="img-circle favicon_user"/>
                                        </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <strong class="primary-font">
                                                    {{$value['first_name']}}{{$value['last_name']}}
                                                </strong>
                                                <small class="pull-right text-muted">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                        {{$value['date']}}
                                                </small>
                                            </div>
                                            <p><?php echo str_replace("\n", "<br>", $value['message']); ?></p>
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
                            <span class="glyphicon glyphicon-user"></span><h4 class="d-inline"> Membres du salon</h4>
		                </div>
		                <div class="panel-body body-panel">
		                    <ul class="chat">
                                @foreach($users as $user)
                                    @foreach($user as $u)
                                        @if($u->id !== Auth::id())
                                        <li class="clearfix">
                                            <div class="chat-body clearfix">
                                                <div class="col-xs-6 text-left padding-top-strong">
                                                    <strong class="primary-font">{{$u->first_name}} {{$u->last_name}}</strong>
                                                </div>
                                                <div class="col-xs-6 text-right">
                                                    @if(!($user_reported->contains('id_user_reported', $u->id)))
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reporting-{{$u->id}}"> <span class="glyphicon glyphicon-alert" aria-hidden="true"></span></button>
                                                    @endif
                                                    <a href="{{ route('show_user', ['id' => $u->id] )}}" class="btn btn-warning" id="btn-chat">Consulter le profil</a>
                                                </div>
                                            </div>
                                        </li>
                                        <div id="reporting-{{$u->id}}" class="modal fade" role="dialog">
                                            {{ Form::open(['route' => 'report_user', 'method' => 'post', 'class' => 'col-md-12']) }}
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Signalement de l'utilisateur {{$u->first_name}} {{$u->last_name}}</h4>
                                                        <input type="hidden" id="id_reported" name="id_reported" value="{{$u->id}}"/>
                                                        <input type="hidden" id="id_room" name="id_room" value="{{$header->id}}"/>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="reason">Pour quelles raisons souhaitez-vous signaler cette utilisateur ?</label>
                                                            <textarea class="form-control" rows="5" name="reason" id="reason"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Valider</button>
                                                    </div>
                                                </div>
                                            </div>
                                            {{Form::close()}}
                                        </div>
                                        @endif
                                    @endforeach
                                @endforeach
		                    </ul>
		                </div>
		        	</div>
					<h2 class="text-center padding-top-25">Invitez vos amis à rejoindre ce salon !</h2>
                    {{ Form::open(['route' => 'invite_user', 'method' => 'post', 'class' => 'col-md-12']) }}
                    <div class="input-group input-group-lg">
                        <input type="text" name="autocomplete_user" id="autocomplete_user" class="form-control" placeholder="Saisissez le prénom de votre ami ?">
                        <input type="hidden" name="id_user" id="id_user"/>
                        <input type="hidden" name="id_room" id="id_room" value="{{$header->id}}"/>
                        <span class="input-group-btn">
                        <button class="btn btn-success" type="submit">Inviter !</button>
                        </span>
                    </div>
                    {{Form::close()}}
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
