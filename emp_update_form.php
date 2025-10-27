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
                             <h2 class="pageheader-title"><i class="fa fa-fw fa-user-lock"></i> Add Employee </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Employee</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
    <?php
    $emp_id = $_REQUEST['emp_id']; 
    $lastname = $_REQUEST['lastname'];
    $firstname = $_REQUEST['firstname'];
    $middlename = $_REQUEST['middlename'];
    $position = $_REQUEST['position'];
    $department = $_REQUEST['department'];
    ?>
    <form id="employeeForm" enctype="multipart/form-data" action="emp_update.php" method="post">

    <span class="input-group-text">Employee ID</span>
    <input type="text" class="form-control" id="emp_id" name="emp_id" value="<?php echo $emp_id;?>" readonly>

    <span class="input-group-text">Last Name</span>
    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lastname;?>" oninput="convertToUpperCase('lastname')" required>
    
    <span class="input-group-text">First Name:</span>
    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $firstname;?>" oninput="convertToUpperCase('firstname')" required>
    
    <span class="input-group-text">Middle Name:</span>
    <input type="text" class="form-control" id="middlename" name="middlename" value="<?php echo $middlename;?>" oninput="convertToUpperCase('middlename')" required>
 
    <span class="input-group-text">Position:</span>
    <input type="text" class="form-control" id="position" name="position" value="<?php echo $position;?>" oninput="convertToUpperCase('position')" required>
        
    <span class="input-group-text">Department:</span>
    <input type="text" class="form-control" id="department" name="department" value="<?php echo $department;?>" oninput="convertToUpperCase('department')" required>
   
      <button type="submit" class="btn btn-primary btn-block">Update Employee Record</button>
 
    </form> 

    </div>
  </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <script type="text/javascript">
        $(document).ready(function(){
          var firstName = $('#firstName').text();
          var lastName = $('#lastName').text();
          var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
          var profileImage = $('#profileImage').text(intials);
        });
    </script>
</div>
<!-- Footer 

<footer class="bg-dark text-white text-center py-3">
  <p>&copy; 2024 UAfrbeas.com ~JRX</p>
</footer>
-->
</body>
</html>
