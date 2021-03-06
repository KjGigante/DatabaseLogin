<?php
	require "dbConnect.php";
	$conn = config::connect();
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
		
		if ($username == "" || $password == "" || $firstName == "" || $lastName == "" || $middleInitial == "" || $studentNumber == "" || $yearLevel == "" || $dateOfBirth == "" || $mobileNumber == "" || $ueEmail == "" || $passwordRepeat == ""){
			return;
		}
		if (substr($dateOfBirth, 0, 4) > 2001 AND substr($dateOfBirth, -5, 2) > 9 AND substr($dateOfBirth, -2, 2) > 10 ){
				echo "". date(Y) ."";
				'<script>
					alert("Warning: Invalid date of birth. Must be at least 18 years. Please try again.");
				</script>';
			echo '<script>
						window.history.go(-1);
					</script>';
		}
		if(!checkUserNameExist($conn,$username)){
			echo '<script>
					alert("Warning: Username already exists. Please try again.");
				</script>';
			echo '<script>
						window.history.go(-1);
					</script>';
			return;
			exit();
		}
		if(!checkEmailExist($conn,$ueEmail)){
			echo '<script>
					alert("Warning: E-mail already exists. Please try again.");
				</script>';
			echo '<script>
						window.history.go(-1);
					</script>';
			return;
			header("Location: mpsignup.html?error=uncheckedcheckbox");
			exit();
		}
		else if(!isset($_POST['termsBox'])){
			echo '<script>
						alert("Warning: Please agree to terms and conditions");
					</script>';
			echo '<script>
							window.history.go(-1);
						</script>';
			
			return;
			header("Location: mpsignup.html?error=uncheckedcheckbox");
			exit();
		}
		
		
		else if ($password !== $passwordRepeat){ //incorrect password
			echo '<script>
					alert("Warning: Password mismatch. Please try again.");
				</script>';
			echo '<script>
						window.history.go(-1);
					</script>';
		}
		else if ($password == $passwordRepeat){//correct password; insertInput - values entered by the user
			insertInput($firstName, $lastName, $middleInitial, $studentNumber, $yearLevel, 
					$dateOfBirth, $mobileNumber, $ueEmail, $username, $password, $passwordRepeat);	
		}
		
		
}//isset closing 
	
	function insertInput($firstName, $lastName, $middleInitial, $studentNumber, $yearLevel, 
					$dateOfBirth, $mobileNumber, $ueEmail, $username, $password){
	try {
		$conn = config::connect();
		$userInput = "INSERT INTO users (firstnameUsers, lastnameUsers, middleinitialUsers, studNoUsers, yrUsers, dobUsers, mobileNoUsers, emailUsers, uidUsers, pwdUsers) VALUES (:firstName,:lastName,:middleInitial,:studentNumber,:yearLevel,:birthDate,:mobileNumber,:emailAdd,:userName,:password)"; 
		$query = $conn->prepare($userInput);		
		$query->bindParam(":firstName",$firstName);
		$query->bindParam(":lastName" ,$lastName);
		$query->bindParam(":middleInitial",$middleInitial);
		$query->bindParam(":studentNumber",$studentNumber);
		$query->bindParam(":yearLevel", $yearLevel);
		$query->bindParam(":birthDate",$dateOfBirth);
		$query->bindParam(":mobileNumber",$mobileNumber);
		$query->bindParam(":emailAdd",$ueEmail);
		$query->bindParam(":userName",$username);
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
		$conn = null;
	}
	function checkUserNameExist($conn, $username){
		$query = $conn->prepare("
			SELECT * FROM users WHERE uidUsers=:username

			");

		$query->bindParam(":username",$username);
		$query->execute(); 
		//check
		if($query->rowCount() == 1){
			return false;
		}
		else{
			return true;
		}
	}
	function checkEmailExist($conn, $ueEmail){
		$query = $conn->prepare("
			SELECT * FROM users WHERE emailUsers=:emailAdd

			");

		$query->bindParam(":emailAdd",$ueEmail);
		$query->execute(); 

		//check
		if($query->rowCount() == 1){
			return false;
		}
		else{
			return true;
		}
	}

		
?>
