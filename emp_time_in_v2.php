<?php

function time_in($emp_id, $image_data) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "frbeas";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if there is a record for today for the employee
    $today = date('Y-m-d');
    $sql = "SELECT * FROM time_record_v2 WHERE emp_id = '$emp_id' AND yyyy = YEAR('$today') AND mm = MONTH('$today') AND dd = DAY('$today')";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
///------------------------------------------------------------------------------------

// Define the base directory where images will be stored
$baseDir = "time_record_img/";

// Create the directory structure if it doesn't exist
$empDir = $baseDir . $emp_id . "/";
if (!is_dir($empDir)) {
    mkdir($empDir, 0777, true);
}

$year = date('Y');
$yearDir = $empDir . $year . "/";
if (!is_dir($yearDir)) {
    mkdir($yearDir, 0777, true);
}

$month = date('m');
$monthDir = $yearDir . $month . "/";
if (!is_dir($monthDir)) {
    mkdir($monthDir, 0777, true);
}

$day = date('d');
$dayDir = $monthDir . $day . "/";
if (!is_dir($dayDir)) {
    mkdir($dayDir, 0777, true);
}

// Generate a unique filename for the image
$filename = $dayDir . "in_am.png";

// Save the image file
$image_data = str_replace('data:image/png;base64,', '', $image_data);
$image_data = str_replace(' ', '+', $image_data);
$image_data = base64_decode($image_data);
file_put_contents($filename, $image_data);

// Insert the record into the database
$sql_insert = "INSERT INTO time_record_v2 (emp_id, in_am, in_am_img, yyyy, mm, dd) VALUES (?,?,?,?,?,?)";
$stmt = $conn->prepare($sql_insert);
$in_am_time = date('H:i:s');
$stmt->bind_param("isssii", $emp_id, $in_am_time, $filename, $year, $month, $day);
if ($stmt->execute()) {
    echo "Timed in(am)";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();


///---------------------------------------------------------------
    
    } else {
       // Define the base directory where images will be stored
$baseDir = "time_record_img/";

// Create the directory structure if it doesn't exist
$empDir = $baseDir . $emp_id . "/";
if (!is_dir($empDir)) {
    mkdir($empDir, 0777, true);
}

$year = date('Y');
$yearDir = $empDir . $year . "/";
if (!is_dir($yearDir)) {
    mkdir($yearDir, 0777, true);
}

$month = date('m');
$monthDir = $yearDir . $month . "/";
if (!is_dir($monthDir)) {
    mkdir($monthDir, 0777, true);
}

$day = date('d');
$dayDir = $monthDir . $day . "/";
if (!is_dir($dayDir)) {
    mkdir($dayDir, 0777, true);
}

// Generate a unique filename for the image
$filename = $dayDir . "in_pm.png";

// Save the image file
$image_data = str_replace('data:image/png;base64,', '', $image_data);
$image_data = str_replace(' ', '+', $image_data);
$image_data = base64_decode($image_data);
file_put_contents($filename, $image_data);

// Record found, check if already timed in-am and out-am
$row = $result->fetch_assoc();
if ($row['in_am'] != '' && $row['out_am'] != '') {
    // Already timed in and out, update in_pm
    if($row['in_pm']==''){
        $sql_update = "UPDATE time_record_v2 SET in_pm = TIME_FORMAT(NOW(), '%H:%i:%s'), in_pm_img = '$filename' WHERE emp_id = '$emp_id' AND yyyy = YEAR('$today') AND mm = MONTH('$today') AND dd = DAY('$today')";
        if ($conn->query($sql_update) === TRUE) {
            echo "Timed in(pm)";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo 'Time in_pm detected! You have already timed in!';
    }
} else {
    if($row['in_am'] != '' && $row['out_am'] == ''){
        echo "You already Timed In! Please Time out Before timing In Again!";
    }
}
    }

    $conn->close();
}


if(isset($_POST['emp_id'])) {
    $emp_id = $_POST['emp_id'];
    $image_data = $_POST['image_data'];

time_in($emp_id,$image_data);
}
?>
