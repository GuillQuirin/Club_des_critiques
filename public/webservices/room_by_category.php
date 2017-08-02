<?php
	include("connec_bdd.php");
	
	// Le tableau de résultat
	$result_request = array();

	$query = "
		SELECT c.name, count(r.name)
		FROM room r
		RIGHT JOIN element e ON r.id_element = e.id
		RIGHT JOIN category c ON e.id_category = c.id
		GROUP BY c.name
	";

	$result = mysqli_query($conn, $query);

	while ($row = mysqli_fetch_array($result)) {
		$result_request[] = array($row[0], intval($row[1]));
	}

	mysqli_free_result($result);

	// Déconnexion de la BDD
	mysqli_close($conn);
	
	// Renvoyer le résultat au javascript
	echo json_encode($result_request);

?>