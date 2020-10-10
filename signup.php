<?php

	if(isset($_POST['signsubmit'])){
		$lastName 		= $_POST ['lName'];
		$firstName     	= $_POST ['fName'];
		$middleInitial 	= $_POST ['mName'];
		$studentNo 		= $_POST ['studno'];
		$yearLevel		= $_POST ['yrlvl'];
		$birthDate		= $_POST ['bday'];
		$mobileNumber 	= $_POST ['phone'];
		$emailAdd       = $_POST ['email'];
		$userName       = $_POST ['user'];
		$passWord       = $_POST ['pass'];
		$passWordRepeat = $_POST ['passrpt'];
	
		if ($passWord == $passWordRepeat){ //correct password; insertInput - values entered by the user
			insertInput($lastName, $firstName, $middleInitial, $studentNo, 
			$yearLevel, $birthDate, $mobileNumber, $emailAdd, $userName,
			$passWord , $passWordRepeat);	
		}//closing ng if
		
		else if ($passWord !== $passWordRepeat){ //incorrect password
			echo '<script>
					alert("Warning: Password mismatch. Please try again.");
				</script>';
			echo '<script>
						window.history.go(-1);
					</script>';
		}//closing ng else 	
				//Checking if the username is unique
			
		else {	
			$sql = "SELECT COUNT(userName) AS uname FROM user_input WHERE user_name=?"; //get the entered value by the user
			$stmt = $conn->prepare($sql)->bindValue(':user_name',$userName)->execute();
			
			//to fetch the row
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

				if($row ['uname'] == true){
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
	}//closing ng isset
	
	function insertInput($lName,$fName,$mName,$studno,$yrlvl,$bday,$phone,$email,$user,$pass){
		try{
			require "dbConnect.php";
			
			$sql = "INSERT INTO user_input (l_name, f_name, m_name, stud_no, yr_lvl, birth_date, 
			 mobile_no, email_add, user_name, pwd) VALUES (?,?,?,?,?,?,?,?,?,?)";
			 $stmt = $conn->prepare($sql)->execute([$lName,$fName,$mName,$studno,$yrlvl,$bday,$phone,$email,$user,$pass]);
			
			
				if($stmt == true) {
					echo '<script>
							alert("Congratulations! You are already registered!");
						 </script>';
				}
				else{
					echo '<script>
							alert("Sorry. Registration failed. Please try again.");
						 </script>';	 
				}	
		}
		catch (PDOException $e){
			echo $sql . $e->getMessage();	
		}
		$conn = null;
	}
?>


















