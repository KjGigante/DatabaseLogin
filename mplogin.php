<?php //dabatabse
require "dbConnect.php";
 if(isset($_POST['logsubmit'])){
 	$username 		= $_POST['user'];
 	$password 		= $_POST['pass'];
 	
 	$con = config::connect();
 	$query = "SELECT * FROM users WHERE uidUsers = :username AND pwdUsers = :password";
 	$statement = $con->prepare($query);
 	$statement->execute(
 		array(
 			'username' => $_POST['user'],
 			'password' => $_POST['pass']
 		)
 	);
 	$count = $statement->rowCount();
 	if($count > 0){
 		header('location:Welcome!.html');
 	}else
 	{
 		echo '<script>
				alert("Wrong credentials. Please try again.");
				window.history.go(-1);
			</script>';
 	}
 }

?>
