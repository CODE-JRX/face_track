<?php include('config/header.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Time Record Report Generator</title>
<script src="jquery/jquery-3.6.0.min.js"></script>
<style>
    .centered-border {
        border: 2px solid #333;
        width: 50%;
        margin: 50px auto 0;
        padding: 20px;
    }
</style>

</head>
<body>
<?php
// Fetch employee name based on emp_id
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "frbeas";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$emp_id = $_GET['emp_id'];
$sql = "SELECT * FROM employee WHERE emp_id = '$emp_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $emp_name = $row['firstname'] . ' ' . $row['lastname']; // Assuming 'firstname' and 'lastname' are columns in your 'employee' table
} else {
    $emp_name = 'Unknown'; // Default value if emp_id is not found
}
?>


<form id="reportForm">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 centered-border">
    
    <p  class="h3" style="display:block;"><h3>Time Record Report Generator</h3></p>
        <label for="emp_id">Employee ID:</label>
        <input type="text" id="emp_id" name="emp_id" value="<?php echo $_GET['emp_id']; ?>" readonly><br><br>
        <label for="emp_name">Employee Name:</label>
        <input type="text" id="emp_name" name="emp_name" value="<?php echo $emp_name; ?>" readonly><br><br>

        <label for="yyyy_mm">YYYY-MM:</label>
        <!---<input type="text" id="yyyy_mm" name="yyyy_mm" placeholder="Enter YYYY-MM">-->
        <input type="text" id="yyyy_mm" name="yyyy_mm" placeholder="YYYY-MM" pattern="\d{4}-\d{2}" title="Please enter a valid YYYY-MM format (e.g., 2024-03)">
<br><br>
        <input type="submit" value="Generate Report">
    
        </div>
    </div>
</div>  
</form>
<div id="response"></div>
<script>
    $(document).ready(function() {
        $('#reportForm').submit(function(e) {
            e.preventDefault();
            var emp_id = $('#emp_id').val();
            var yyyy_mm = $('#yyyy_mm').val();

            $.ajax({
                url: 'report_gen.php',
                type: 'GET',
                data: { emp_id: emp_id, yyyy_mm: yyyy_mm },
                success: function(response) {
                    $('#response').html(response);
                    $('#reportForm').hide(); // Hide the form
                    $('#response').append('<button id="printButton">Print</button>'); // Add the print button
                 
                },
                error: function(xhr, status, error) {
                    console.error('Error generating report:', error);
                    $('#response').html('Error generating report. Please try again.');
                }
            });
        });

        // Add click event for the print button
        $('#response').on('click', '#printButton', function() {
          $('#printButton').hide(); // Hide the print button
            window.print(); // Print the page
           

        });
    });
</script>
</body>
</html>
