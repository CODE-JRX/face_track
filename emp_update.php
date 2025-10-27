<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "frbeas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$emp_id = $_POST['emp_id']; 
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$position = $_POST['position'];
$department = $_POST['department'];

// Update data in database
$sql = "UPDATE Employee SET lastname='$lastname', firstname='$firstname', middlename='$middlename', position='$position', department='$department' WHERE emp_id=$emp_id";

if ($conn->query($sql) === TRUE) { 
    echo '<script>alert("Employee data updated!"); window.location.href = "data_employees.php";</script>';

} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();
?>
