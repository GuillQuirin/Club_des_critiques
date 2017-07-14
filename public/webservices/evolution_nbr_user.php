<?php

setlocale(LC_TIME, "fr_FR");

	$result_total = array();
	$result_cpt = array();
	$result_request = array();
	

	// Connexion à la BDD
	$servername = "localhost";
	$username = "root";
	$password = "";
	$bdd_name = "club_critique";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $bdd_name);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	// Set le charset en UTF8 (pour éviter les problèmes d'accent)
	mysqli_set_charset($conn, "utf8");
	

	$query = "SELECT date_created, count(*) as 'nbr'
		FROM user
		GROUP BY date_created";

	$result = mysqli_query($conn, $query);
	
	$cpt = 0;
	while ($row = mysqli_fetch_array($result)) {
		$cpt = $cpt + intval($row[1]);
		$date = new DateTime($row[0]);

		array_push($result_cpt, $cpt);
		array_push($result_request, $date->format('d/m/Y'));
	}

	array_push($result_total, array_slice($result_cpt, -15));
	array_push($result_total, array_slice($result_request, -15));

	mysqli_free_result($result);

	// Déconnexion de la BDD
	mysqli_close($conn);
	
	// Renvoyer le résultat au javascript
	echo json_encode($result_total);

?>