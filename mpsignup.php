<?php
if (isset($_POST['signsubmit'])) {

	require 'dbh.php';

	$username = $_POST['user'];
	$ueEmail = $_POST['email'];
	$password = $_POST['pass'];
	$passwordRepeat = $_POST['passrpt'];
	$firstName = $_POST['fName'];
	$lastName = $_POST['lName'];
	$middleInitial = $_POST['mName'];
	$studentNumber = $_POST['studno'];
	$MobileNumber = $_POST['phone'];
	$checkBox = $_POST['termsBox'];
	$dateOfBirth = $_POST['bday'];
	$yearLevel = $_POST['yrlvl'];
	$yearDOBString = substr($dateOfBirth, 0, 4);
		
	if (substr($dateOfBirth, 0, 4) > 2001 AND substr($dateOfBirth, -5, 2) > 9 AND substr($dateOfBirth, -2, 2) > 10 ){
				header("Location: mpsignup.html?error=dateofbirthtooyoung");
				exit();
			}
			
	else if(!isset($_POST['termsBox'])){
		header("Location: mpsignup.html?error=uncheckedcheckbox");
		exit();
	}

	else if (!filter_var($ueEmail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: mpsignup.html?error=invaliduidemail");
		exit();
	}
	else if (!filter_var($ueEmail, FILTER_VALIDATE_EMAIL)) {
		header("Location: mpsignup.html?error=invalidemail&uid=".$username);
		exit();
	}
	else if (!preg_match("/^[a-zA-Z-_]*$/", $username)) {
		header("Location: mpsignup.html?error=invaliduid&email=".$ueEmail);
		exit();
	}
	else if ($password !== $passwordRepeat) {
		header("Location: mpsignup.html?error=passwordcheck&email=".$ueEmail."&uid=".$username);
		exit();
	}

	else{

		$sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: mpsignup.html?error=sqlerror");
			exit();
		} 
		else{
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0) {
				header("Location: mpsignup.html?error=usertaken&email=".$ueEmail);
				exit();
			}
			else{

				$sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, firstnameUsers, lastnameUsers, middleinitialUsers, studNoUsers, mobileNoUsers, dobUsers, yrUsers) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: mpsignup.html?error=sqlerror");
				exit();
				} else{
					$hashedpwd = password_hash($password, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt, "ssssssssss", $username, $ueEmail, $hashedpwd, $firstName, $lastName, $middleInitial, $studentNumber, $MobileNumber, $dateOfBirth, $yearLevel);
					mysqli_stmt_execute($stmt);
					header("Location: mpsignup.html?signup=success");

					exit();
				}
			}
		}

	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);


}
else{
	header("Location: mpsignup.html");
	exit();
}

?>