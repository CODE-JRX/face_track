<?php
if(ISSET($_POST)){
    $emp_id = trim($_POST['emp_id']);
    deleteEmployee($emp_id);
}


function deleteEmployee($emp_id) {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "frbeas";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete record from employee table
    $sql = "DELETE FROM employee WHERE emp_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $emp_id);
    $stmt->execute();

    // Remove entry from Python file

    $python_file = "reg_emp_v2.py";
    $python_content = file_get_contents($python_file);
    
    // Construct the pattern to match the employee ID and its face encodings
    $pattern = '/\s*"' . $emp_id . '": \[.*?\],?\s*/s';
    
    // Remove the matched entry from the content
    $new_content = preg_replace($pattern, '', $python_content);
    
    // Write the modified content back to the file
    if (file_put_contents($python_file, $new_content)) {
        //echo "Entry removed successfully from reg_emp_v2.py";
    } else {
       // echo "Error removing entry from reg_emp_v2.py";
    }
  
    
    

    // Delete image file
    $image_path = "employees/" . $emp_id . ".jpg";
    if (file_exists($image_path)) {
        unlink($image_path);
        echo '<div class="alert alert-success">Employee Record Deleted Successfully!</div>';

    }
    else{
        echo '<div class="alert alert-success">Error Deleting Data!</div>';

    }

    $stmt->close();
    $conn->close();
}


?>
