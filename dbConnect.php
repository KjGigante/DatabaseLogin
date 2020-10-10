<?php

	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "";

	try{
		$conn = new PDO("mysql:host = $servername;dbname=loginsignup",$dbusername,$dbpassword); //connection for mysql
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //set the PDO error mode to exception
			echo "Connected Successfully!"	;
	}
	catch(PDOException $e){
		echo "Connection failed" . $e->getMessage();
	}

?>

