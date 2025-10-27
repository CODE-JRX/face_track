<?php
  require_once "class_model.php";
	if(ISSET($_POST)){
		$conn = new class_model();
		
		$name = trim($_POST['name']);
		$user_type = trim($_POST['usertype']);
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$status = "1";

		$user = $conn->add_user($name, $user_type, $username, $password, $status,);
		if($user == TRUE){
		    echo '<div class="alert alert-success">Add User Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Add User Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>

