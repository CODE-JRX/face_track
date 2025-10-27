<?php
  require_once "class_model.php";
	if(ISSET($_POST)){
		$conn = new class_model();

		$name = trim($_POST['name']);
		$user_type = trim($_POST['user_type']);
		
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$status = trim($_POST['status']);
		$id = trim($_POST['id']);

		$user = $conn->edit_user($name, $user_type, $username, $password, $status, $id);
		if($user == TRUE){
		    echo '<div class="alert alert-success">Edit User Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 2000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Edit User Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>

