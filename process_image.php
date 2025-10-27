<?php
if(isset($_POST['image_data'])) {
    $imageData = $_POST['image_data'];
    $decodedImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
    
    // Save the image to a file
    $filename = 'captured_image.png';
    file_put_contents($filename, $decodedImage);

    // Activate the Conda environment
    //$condaActivateCommand = 'conda activate tf && ';

    // Run the Python script to identify the employee
    $pythonCommand = 'python py.py ' . escapeshellarg($filename);

    // Combine the commands
    $fullCommand = $pythonCommand;

    // Execute the command and get the employee ID
    $output = shell_exec($fullCommand);
    $emp_id = trim($output);

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "frbeas";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the database to get the employee name
    $sql = "SELECT CONCAT(firstname, ' ', lastname) AS emp_name FROM Employee WHERE emp_id = '$emp_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output the employee name
        $row = $result->fetch_assoc();
        $emp_name = $row["emp_name"];
        echo 'ID number: '.$emp_id.'<br>';
        echo 'Employee: '.$emp_name;
        
    } else {
        echo "Employee not found";
        
    }

    $conn->close();
} else {
    echo "No image data received.";
}
?>
