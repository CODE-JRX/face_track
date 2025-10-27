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

// Insert employee data into the database
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$position = $_POST['position'];
$department = $_POST['department'];
$biometric = $_FILES['biometric'];

// Insert data into database
$sql = "INSERT INTO Employee (lastname, firstname, middlename, position, department, biometric) 
        VALUES ('$lastname', '$firstname', '$middlename', '$position', '$department', '')"; 

if ($conn->query($sql) === TRUE) {
    $emp_id = $conn->insert_id; // Get the emp_id of the inserted record
    // Save image to server with emp_id as filename
    $imageFileName = "employees/{$emp_id}.jpg";
    move_uploaded_file($biometric['tmp_name'], $imageFileName);

    // Update the biometric field in the database with the image filename
    $updateSql = "UPDATE Employee SET biometric='$imageFileName' WHERE emp_id=$emp_id";
    if ($conn->query($updateSql) === TRUE) {
        echo '<script>alert("Added Employee Successfully!");setTimeout(function() {  window.history.go(-1); }, 1000);  </script>';
        
        // Call the Python script to update the face recognition data
        $pythonScriptPath = 'known_face_encoder.py';
        $command = "python $pythonScriptPath $emp_id $imageFileName";
        exec($command, $output, $return_var);
        if ($return_var !== 0) {
            echo "Error calling Python script: " . implode("\n", $output);
        }
        
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
