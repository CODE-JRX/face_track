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
        echo 'No record detected. Please Time in!';
    } else {
        // Record found, check if already timed in or out
        $row = $result->fetch_assoc();
        if ($row['in_pm'] != '') {
            if($row['out_pm'] == '') {
                // Already timed out_am and in_pm, update out_pm

//store image in time_record_img
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
$filename = $dayDir . "out_pm.png";
// Save the image file
$image_data = str_replace('data:image/png;base64,', '', $image_data);
$image_data = str_replace(' ', '+', $image_data);
$image_data = base64_decode($image_data);
file_put_contents($filename, $image_data);
///end of storing image

                $sql_update = "UPDATE time_record_v2 SET out_pm = TIME_FORMAT(NOW(), '%H:%i:%s'), out_pm_img = '$filename' WHERE emp_id = '$emp_id' AND yyyy = YEAR('$today') AND mm = MONTH('$today') AND dd = DAY('$today')";
                if ($conn->query($sql_update) === TRUE) {
                    echo "Timed out(pm)";
                } else {
                 echo "Error updating record: " . $conn->error;
                
                }
            }
            else{
                echo'You already Timed out(pm)!';
            }
        } 
        else{
            if($row['in_am'] != '' && $row['out_am'] == ''){
            // Already timed in_am, update out_am

///----------------store image--------------------------------------------------------------------
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
$filename = $dayDir . "out_am.png";

// Save the image file
$image_data = str_replace('data:image/png;base64,', '', $image_data);
$image_data = str_replace(' ', '+', $image_data);
$image_data = base64_decode($image_data);
file_put_contents($filename, $image_data);
///--end of storing image
            $sql_update = "UPDATE time_record_v2 SET out_am = TIME_FORMAT(NOW(), '%H:%i:%s'), out_am_img = '$filename' WHERE emp_id = '$emp_id' AND yyyy = YEAR('$today') AND mm = MONTH('$today') AND dd = DAY('$today')";
                if ($conn->query($sql_update) === TRUE) {
                    echo "Timed out(am)";
                } else {
                    echo "Error updating record: " . $conn->error;
                
                }
            }
            else{
                echo 'No time in(pm) detected. Please time in!';
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
