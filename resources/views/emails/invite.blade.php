<p>Bonjour {{$receiver->first_name}} {{$receiver->last_name}},</p>

<p>{{$sender->first_name}} {{$sender->last_name}} vous a invité à rejoindre le salon "{{$room->name}}" du Club des Critiques.</p>
<p><strong>Nous vous invitons à vous connecter sur le site avant de cliquer sur ce lien.</strong></p>
<p>Voici <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/join_room?room=<?php echo $room->id; ?>">le lien</a>.</p>

<p>Cordialement</p>