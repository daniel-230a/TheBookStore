<?php
	$servername = "katara.scam.keele.ac.uk";
	$username = "x1p49";
	$password = "";
	$dbname = "x1p49";

	static $db;

	try {

		if (!$db) {
			$db = new PDO('mysql:host='.$servername.';dbname='.$dbname, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
		 }
		 return $db;
		
	} catch(PDOException $e) {
		die("There has been a connection error"); 
	}
	
?>