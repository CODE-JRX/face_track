<?php include('config/header.php');?>
<?php include('config/sidebar.php');?>
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                             <h2 class="pageheader-title"><i class="fas fa-print"></i>Print Employee Time Record </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Print</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
               
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Employees Information</h5>
                                <div class="card-body">
                                    <div id="message"></div>
                                    <div class="table-responsive">
                        
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    
                                                    <th scope="col">Last Name</th>
                                                    <th scope="col">First Name</th>
                                                    <th scope="col">Middle Name</th>
                                                    <th scope="col">Position</th>
                                                    <th scope="col">Deaprtment</th>
                                                    <th scope="col">Biometric Data</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php 
                                                $conn = new class_model();
                                                $employee = $conn->fetchAll_employees();
                                                
                                               ?>
                                               <?php foreach ($employee as $row) { ?>
                                                <tr>
                                                    <td><?= $row['lastname']; ?></td>
                                                    <td><?= $row['firstname']; ?></td>
                                                    <td><?= $row['middlename']; ?></td>
                                                    <td><?= $row['position']; ?></td>
                                                    <td><?= $row['department']; ?></td>
                                                    <td><?= $row['biometric']; ?></td>
                                                    <td class="align-right">
                                                        
                                                        <a href="time_record.php?emp_id=<?= $row['emp_id']; ?>&fname=<?php echo $row['firstname']; ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                        <i class="fas fa-print"></i>
                                                        </a>
                                                      </td>
                                                </tr>
                                             <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end responsive table -->
                        <!-- ============================================================== -->
                    </div>
               
            </div>
            
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
    <script>
    $(document).ready(function() {

        load_data();

        var count = 1;

        function load_data() {
            $(document).on('click', '.delete', function() {

                var emp_id = $(this).attr("data-id");
                
                if (confirm("Are you sure want to remove this data?")) {
                    $.ajax({
                        url: "del_emp.php",
                        method: "POST",
                        data: {
                            emp_id: emp_id
                        },
                      success: function(response) {

                          $("#message").html(response);
                          },
                          error: function(response) {
                            console.log("Failed");
                          }
                    })
                }
            });
        }

    });
</script>
</body>
 
</html>