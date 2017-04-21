@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/rooms.css')}}">
@endsection

@section('title')
    Salon - Titre du livre
@endsection

@section('content')
		<div class="row">
            <h1 class="text-center col-xs-10 col-xs-offset-1 col-sm-10">Nom du salon
                <small>Du 01/07/2017 au 01/09/2017</small>
            </h1>
            <div class="col-sm-3 col-sm-offset-1">
                <img src="http://iut.univ-amu.fr/sites/iut.univ-amu.fr/files/departement/1472852001.jpg"
                     class="valig-center col-xs-12 col-sm-12">
            </div>
            <div class="col-sm-7">
                <div class="panel-group">
                    <div class="panel panel-color panel-border">
                        <div class="panel-heading">
                            Informations
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-6">
                                <p>Type d'oeuvre:</p>
                                <p>Titre :</p>
                                <p>Auteur:</p>
                                <p>Année de parution :</p>
                            </div>
                            <div class="col-sm-6">
                                <p>Votre note :</p>
                                <p>Note globale des lecteurs :</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-color panel-border">
                        <div class="panel-heading">
                            Synopsis
                        </div>
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="text-center text-uppercase col-sm-12">Titre du livre <small>Nom Prénom de l'auteur</small></h1>
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
		                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-refresh">
		                            </span>Rafraîchir</a></li>
		                        </ul>
		                    </div>
		                </div>
		                <div class="panel-body body-panel">
		                    <ul class="chat">
		                        <li class="left clearfix"><span class="chat-img pull-left">
		                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
		                        </span>
		                            <div class="chat-body clearfix">
		                                <div class="header">
		                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
		                                        <span class="glyphicon glyphicon-time"></span>20 mins ago</small>
		                                </div>
		                                <p>
		                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
		                                    dolor, quis ullamcorper ligula sodales.
		                                </p>
		                            </div>
		                        </li>
								<li class="left clearfix"><span class="chat-img pull-left">
		                            <img src="http://placehold.it/50/55C1E7/fff&text=EP" alt="User Avatar" class="img-circle" />
		                        </span>
									<div class="chat-body clearfix">
										<div class="header">
											<strong class="primary-font">Elise Poirier</strong> <small class="pull-right text-muted">
												<span class="glyphicon glyphicon-time"></span>15 mins ago</small>
										</div>
										<p>
											Guillaume tu veux sortir avec moi ?
										</p>
									</div>
								</li>
								<li class="left clearfix"><span class="chat-img pull-left">
		                            <img src="http://placehold.it/50/55C1E7/fff&text=QR" alt="User Avatar" class="img-circle" />
		                        </span>
									<div class="chat-body clearfix">
										<div class="header">
											<strong class="primary-font">Guillaume Quirin</strong> <small class="pull-right text-muted">
												<span class="glyphicon glyphicon-time"></span>12 mins ago</small>
										</div>
										<p>
											Pour quoi faire ?
										</p>
									</div>
								</li>
								<li class="left clearfix"><span class="chat-img pull-left">
		                            <img src="http://placehold.it/50/55C1E7/fff&text=LG" alt="User Avatar" class="img-circle" />
		                        </span>
									<div class="chat-body clearfix">
										<div class="header">
											<strong class="primary-font">Laurie Guibert</strong> <small class="pull-right text-muted">
												<span class="glyphicon glyphicon-time"></span>10 mins ago</small>
										</div>
										<p>
											Au secours !
										</p>
									</div>
								</li>
		                    </ul>
		                </div>
		                <div class="panel-footer clearfix">
		                    <textarea class="form-control" rows="3"></textarea>
		                    <span class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-xs-12" style="margin-top: 10px">
		                        <button class="btn btn-warning btn-lg btn-block" id="btn-chat">Envoyer le message</button>
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
		                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-refresh">
		                            </span>Rafraîchir</a></li>
		                        </ul>
		                    </div>
		                </div>
		                <div class="panel-body body-panel">
		                    <ul class="chat">
		                        <li class="clearfix">
		                            <div class="chat-body clearfix">
                                        <div class="col-xs-6 text-left padding-top-strong">
                                            <strong class="primary-font">Jack Sparrow</strong>
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <button class="btn btn-warning" id="btn-chat">Signaler</button>
                                            <button class="btn btn-warning" id="btn-chat">Contacter</button>
                                        </div>
		                            </div>
		                        </li>
		                        <li class="clearfix">
		                            <div class="chat-body clearfix">
                                        <div class="col-xs-6 text-left padding-top-strong">
                                            <strong class="primary-font">Elise Poirier</strong>
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <button class="btn btn-warning" id="btn-chat">Signaler</button>
                                            <button class="btn btn-warning" id="btn-chat">Contacter</button>
                                        </div>
		                            </div>
		                        </li>
		                        <li class="clearfix">
		                            <div class="chat-body clearfix">
                                        <div class="col-xs-6 text-left padding-top-strong">
                                            <strong class="primary-font">Guillaume Quirin</strong>
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <button class="btn btn-warning" id="btn-chat">Signaler</button>
                                            <button class="btn btn-warning" id="btn-chat">Contacter</button>
                                        </div>
		                            </div>
		                        </li>
		                        <li class="clearfix">
		                            <div class="chat-body clearfix">
                                        <div class="col-xs-6 text-left padding-top-strong">
                                            <strong class="primary-font">Laurie Guibert</strong>
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <button class="btn btn-warning" id="btn-chat">Signaler</button>
                                            <button class="btn btn-warning" id="btn-chat">Contacter</button>
                                        </div>
		                            </div>
		                        </li>
		                    </ul>
		                </div>
		        	</div>
					<div class="col-md-12 text-center">
                        <a href="#" class="btn btn-warning btn-lg" role="button">Ajouter un contact <span class="glyphicon glyphicon-plus"></span></a>
                    </div>
				</div>
		    </div>
		</div>
@endsection

