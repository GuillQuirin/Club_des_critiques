<?php
	include("connec_bdd.php");

	setlocale(LC_TIME, "fr_FR");

	$result_total = array();
	$result_cpt = array();
	$result_request = array();	

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