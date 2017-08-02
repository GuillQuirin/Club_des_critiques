<?php 

// Connexion à la BDD
$handle = fopen(__DIR__."/../../.env", "r");

while (($buffer = fgets($handle, 4096)) !== false) {
	$key = substr($buffer, 0, strpos($buffer, "="));
	$value = trim(substr($buffer, strpos($buffer, "=")+1)); 
	
	if($key == "DB_HOST")
		$servername = $value;

	if($key == "DB_DATABASE")
		$bdd_name = $value;

	if($key == "DB_USERNAME")
		$username = $value;

	if($key == "DB_PASSWORD")
		$password = $value;
}

fclose($handle);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $bdd_name);

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Set le charset en UTF8 (pour éviter les problèmes d'accent)
mysqli_set_charset($conn, "utf8");