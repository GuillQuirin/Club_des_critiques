<p>Bonjour 

@if($receiver->first_name)
	{{$receiver->first_name}}
@else
	Utilisateur-{{$receiver->id}}
@endif
,</p>

<p>L'utilisateur {{$sender}} souhaite vous contacter, voici son message :</p>
<p>{{$text}}</p>

<p>Vous trouvez ce message offensant ? Avertissez-nous en nous contactant depuis <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/">le formulaire du site</a>.</p>
<p>Si vous ne souhaitez plus être contactés, vous pouvez configurer vos préférences depuis <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/user/{{$receiver->id}}">votre profil</a>.</p>

<p>Merci et à bientôt,</p>