<?php

function insertTimeRecord($emp_id) {
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
        // Insert record into time_record table
        $row = $result->fetch_assoc();
        $emp_name = $row["emp_name"];
        $date = date("Y-m-d");
        $time = date("H:i:s");

        $sql_insert = "INSERT INTO time_record (emp_id, emp_name, date, time) VALUES ('$emp_id', '$emp_name', '$date', '$time')";
        if ($conn->query($sql_insert) === TRUE) {
            echo "Time in successful! Time: ". $time;
        } else {
            echo "Error inserting record: " . $conn->error;
        }
    } else {
        echo "Employee not found";
    }

    $conn->close();
}
if(isset($_POST['emp_id'])) {
    $emp_id = $_POST['emp_id'];

insertTimeRecord($emp_id);
}
?>
