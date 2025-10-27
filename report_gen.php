<?php
function generatePrintableTimeRecord($emp_id, $yyyy_mm) {
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "frbeas";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the database to get employee name
    $sql_emp = "SELECT CONCAT(firstname, ' ', lastname) AS emp_name FROM Employee WHERE emp_id = '$emp_id'";
    $result_emp = $conn->query($sql_emp);

    if ($result_emp->num_rows > 0) {
        $row_emp = $result_emp->fetch_assoc();
        $emp_name = $row_emp["emp_name"];

        // Query the database to get time records
        $yyyy = substr($yyyy_mm, 0, 4);
        $mm = substr($yyyy_mm, 6, 1);
        $sql_time_record = "SELECT * FROM time_record_v2 WHERE emp_id = '$emp_id' AND yyyy = '$yyyy' AND mm = '$mm'";
        $result_time_record = $conn->query($sql_time_record);

        if ($result_time_record->num_rows > 0) {
            // Output the printable page
            echo "<center><p><h2 class='header'>University of Abra<br>Main Campus, Lagangilang Abra<br>Daily Time Record</h2></p></center> <h4> Name:". $emp_name ."<br>Date: ". $yyyy_mm."</h4>";
            echo "<table border='1'class='table table-striped table-bordered first'>
                    <tr>
                        <th>Date</th>
                        <th>Time in Morning</th>
                        <th>Time out Morning</th>
                        <th>Time in Afternoon</th>
                        <th>Time out Afternoon</th>
                    </tr>";
            while ($row_time_record = $result_time_record->fetch_assoc()) {
                $date = $row_time_record["dd"];
                $in_am = $row_time_record["in_am"];
                $out_am = $row_time_record["out_am"];
                $in_pm = $row_time_record["in_pm"];
                $out_pm = $row_time_record["out_pm"];
                echo "<tr>
                        <td>$date</td>
                        <td>$in_am</td>
                        <td>$out_am</td>
                        <td>$in_pm</td>
                        <td>$out_pm</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No time records found for $emp_name - $yyyy_mm";
        }
    } else {
        echo "Employee not found";
    }

    $conn->close();
}
if (isset($_GET['emp_id']) && !empty($_GET['emp_id'])) {
    $emp_id = $_GET['emp_id'];
    $yyyy_mm = $_GET['yyyy_mm'];
generatePrintableTimeRecord($emp_id, $yyyy_mm);}
?>
