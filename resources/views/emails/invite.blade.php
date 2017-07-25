<p>Bonjour {{$receiver->first_name}} {{$receiver->last_name}},</p>

<p>{{$sender->first_name}} {{$sender->last_name}} vous a invité à rejoindre le salon "{{$room->name}}" du Club des Critiques.</p>
<p>Voici <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/join_room?room=<?php echo $room->id; ?>">le lien</a>.</p>
<p>Nous vous invitons à vous connecter avant de rejoindre ce salon.</p>

<p>Cordialement</p>