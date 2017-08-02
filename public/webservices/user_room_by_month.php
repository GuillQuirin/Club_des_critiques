<?php
	include("connec_bdd.php");

	$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"); 
	$months = array();
	$month_fr = array();
	$rooms = array();
	$avg = array();

	$query = "
		SELECT ur.id_room, month(r.date_start) as 'month', count(*) as 'nb'
		FROM user_room ur, room r
		WHERE r.id = ur.id_room
		GROUP BY id_room
		ORDER BY month
	";

	$result = mysqli_query($conn, $query);
	
	while ($row = mysqli_fetch_array($result)) {
		if (!in_array($row['month'], $months)) {
			array_push($months, $row['month']);
			array_push($month_fr, $mois[$row['month']]);
		}

		if (!in_array($row['id_room'], $rooms)) {
			array_push($rooms, $row['id_room']);
		}
	}

	$result = mysqli_query($conn, $query);

	foreach ($months as $month) {
		$cpt = 0;
		$total = 0;
		while ($row = mysqli_fetch_array($result)) {

			if($month == $row['month']){
				$cpt ++;
				$total += $row['nb'];
			}
		}
		array_push($avg, ($total/$cpt));
		$result = mysqli_query($conn, $query);
	}

	mysqli_free_result($result);

	// Déconnexion de la BDD
	mysqli_close($conn);
	
	// Renvoyer le résultat au javascript
	echo json_encode([$month_fr, $avg]);

?>