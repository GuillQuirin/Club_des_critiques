<?php
	include("connec_bdd.php");

	$nbrRoom = 0;
	$totalUser = 0;
	$avg = 0;

	$query = "
		SELECT r.id, count(u.id)
		FROM room r
		RIGHT JOIN user_room u ON r.id = u.id_room
		GROUP BY r.id
	";

	$result = mysqli_query($conn, $query);
	
	while ($row = mysqli_fetch_array($result)) {
		$nbrRoom ++;
		$totalUser += $row[1];
	}

	mysqli_free_result($result);

	$avg = ($totalUser/$nbrRoom);
	$avg = round($avg, 2);

	// Déconnexion de la BDD
	mysqli_close($conn);
	
	// Renvoyer le résultat au javascript
	echo json_encode($avg);

?>