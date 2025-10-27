<?php include('config/header.php');?>
<?php include('config/sidebar.php');?>

<!-- wrapper  -->
        <!-- ============================================================== -->
  <div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
               <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                             <h2 class="pageheader-title"><i class="fas fa-tachometer-alt"></i> Dashboard </h2>
                           
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
<script src="chart/chart.js"></script>

<!-- Body Content -->
<div class="container mt-2 mx-2"> <!--mt:topmargin, mx:sidesmargin-->
  <div class="row">
    <div class="col-md-3">
    
    </div>
    <div >
      
      <div class="row" >
        <div class="col">
          <canvas id="employeePieChart" width="400" height="400"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
  </div>
<!-- Footer 
<footer class="bg-dark text-white text-center py-3">
  <p>&copy; <?php echo date("Y"); ?> Your Website</p>
</footer>
-->
<!-- PHP to fetch data and initialize Chart.js -->
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "frbeas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the total number of employees
$sql_total_employees = "SELECT COUNT(emp_id) as total_employees FROM Employee";
$result_total_employees = $conn->query($sql_total_employees);
$row_total_employees = $result_total_employees->fetch_assoc();
$total_employees = $row_total_employees["total_employees"];

// Get the number of employees currently timed in today
$current_date = date("Y-m-d");
$yyyy = date("Y");
$dd = date("d");
$mm = intval(date("m"));


$sql_timed_in_today = "SELECT COUNT(DISTINCT emp_id) as timed_in_today FROM Time_record_v2 WHERE `yyyy`='$yyyy' and `mm`='$mm' and `dd`='$dd'";

$result_timed_in_today = $conn->query($sql_timed_in_today);
$row_timed_in_today = $result_timed_in_today->fetch_assoc();
$timed_in_today = $row_timed_in_today["timed_in_today"];
//echo "<script> alert('$timed_in_today $yyyy $dd $mm'); </script>";
// Close the database connection
$conn->close();
?>

<script>
// Chart.js code to create a pie chart
var ctx = document.getElementById('employeePieChart').getContext('2d');
var employeePieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Total Employees', 'Timed In Today'],
        datasets: [{
            label: 'Employee Data',
            data: [<?php echo $total_employees; ?>, <?php echo $timed_in_today; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>

<script type="text/javascript">
        $(document).ready(function(){
          var firstName = $('#firstName').text();
          var lastName = $('#lastName').text();
          var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
          var profileImage = $('#profileImage').text(intials);
        });
    </script>

</body>
</html>
