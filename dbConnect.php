<?php //dhb.php
	class config {
		public static function connect(){
			$servername = "localhost";
			$dbusername = "root";
			$dbpassword = "";
			$dbname = "signupdb";
			//database name is signupdb
			
			try {
				$conn = new PDO ("mysql:host=$servername;dbname=$dbname",$dbusername,$dbpassword);
				
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				}
			
			catch (PDOException $e) {
				echo "Connection Failed! Please try again." . $e->getMessaege();
			}
			return $conn;
		}
	}
?>

