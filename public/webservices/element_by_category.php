<?php
	include("connec_bdd.php");

	// Le tableau de résultat
	$result_request = array();

	$query = "
		SELECT c.name, count(e.name)
		FROM element e
		RIGHT JOIN category c ON e.id_category = c.id
		WHERE c.id_parent = 1
		AND c.is_deleted = 0
		GROUP BY c.name
	";

	$result = mysqli_query($conn, $query);

	while ($row = mysqli_fetch_array($result)) {
		$result_request[] = array($row[0], intval($row[1]));
	}

	mysqli_free_result($result);

	// // Déconnexion de la BDD
	mysqli_close($conn);

	
	// Renvoyer le résultat au javascript
	echo json_encode($result_request);

?>