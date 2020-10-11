<?php
	require "dbConnect.php";
	
	if (isset($_POST['signsubmit'])){
		
		$firstName 		= $_POST['fName'];
		$lastName 		= $_POST['lName'];
		$middleInitial	= $_POST['mName'];
		$studentNumber 	= $_POST['studno'];
		$yearLevel 		= $_POST['yrlvl'];
		$dateOfBirth 	= $_POST['bday'];
		$mobileNumber 	= $_POST['phone'];
		$ueEmail 		= $_POST['email'];
		$username 		= $_POST['user'];
		$password 		= $_POST['pass'];
		$passwordRepeat = $_POST['passrpt'];
		$checkBox 		= $_POST['termsBox'];
		
		if ($password == $passwordRepeat){//correct password; insertInput - values entered by the user
			insertInput($firstName, $lastName, $middleInitial, $studentNumber, $yearLevel, 
					$dateOfBirth, $mobileNumber, $ueEmail, $username, $password, $passwordRepeat);	
		}
		
		else if ($password !== $passwordRepeat){ //incorrect password
			echo '<script>
					alert("Warning: Password mismatch. Please try again.");
				</script>';
			echo '<script>
						window.history.go(-1);
					</script>';
		}
		
		else { //for unique username
			$uniqueUsername = "SELECT * FROM users WHERE userName=?";
		
			$query = $con->prepare($uniqueUsername);
			$query->bindParam(":userName",$username);
			$query-execute();
						
				if ($query-> rowCount() == 1){
					echo '<script>
							alert("Unique username!");
						  </script>';
				}
				else {
					echo '<script>
							alert("Warning: Username is already taken. Please try again.");
						 </script>';	
				}
		}
}//isset closing 
	
	function insertInput($firstName, $lastName, $middleInitial, $studentNumber, $yearLevel, 
					$dateOfBirth, $mobileNumber, $ueEmail, $username, $password, $passwordRepeat){
	try {
		include_once("dbConnect.php")
		$con = config::connect();
		$userInput = "INSERT INTO users (firstName, lastName, middleInitial, studentNumber, yearLevel, birthDate, 
					 mobileNumber, emailAdd, userName, password) VALUES (?,?,?,?,?,?,?,?,?,?)"; 		
					 
		$query = $con->prepare($userInput);
		
		$query->bindParam(":firstName",$firstName);
		$query->bindParam(":lastName" ,$lastName);
		$query->bindParam(":middleInitial",$middleInitial);
		$query->bindParam(":studentNumber",$studentNumber);
		$query->bindParam(":yearLevel", $yearLevel);
		$query->bindParam(":birthDate",$dateOfBirth);
		$query->bindParam(":mobileNumber",$mobileNumber);
		$query->bindParam(":emailAdd",$ueEmail);
		$query->bindParam(":userName",$userName);
		$query->bindParam(":password",$password); 
		
		$query->execute(); 
		
			if ($query == true){
				echo '<script>
						alert ("Congratulations! You are already registered!");
					 </script>';
			}
			else {
				echo '<script>
						alert ("Sorry. Registration failed. Please try again.");
					 </script>'; 
			}
		
	}
	catch (PDOException $e){
			echo $userInput . $e->getMessage();	
		}
		$con = null;
	}

		
?>
