<?php
  require_once "class_model.php";;
	if(ISSET($_POST)){
		$conn = new class_model();
		$emp_id = trim($_POST['emp_id']);
		$employee = $conn->delete_employee($emp_id);
		if($employee == TRUE){
		    echo '<div class="alert alert-success">Delete Employee Successfully!';

		  }else{
			echo '<div class="alert alert-danger">Delete Employee Failed!</div>';
		}
	}
?>

