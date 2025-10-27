<?php 
	include 'connection2.php';
	session_start();

	$username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
	

    $sql = "SELECT * FROM users where username='$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row){
        $user= $row["username"]; 
        $pass= $row["password"]; 
                            
        $_SESSION['login_id'] = "5" . "-" . $row['id'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['login_user_type'] = $row["user_type"];
        $_SESSION['login_name'] = $row['name'];
        echo 2; 
            }



	
?>