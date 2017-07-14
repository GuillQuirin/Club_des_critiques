<?php

	// Le tableau de résultat
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