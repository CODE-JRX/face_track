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
                             <h2 class="pageheader-title"><i class="fa fa-fw fa-user-lock"></i> Users </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                                <h5 class="card-header">Users Information</h5>
                                <div class="card-body">
                                    <div id="message"></div>
                                    <div class="table-responsive">
                                        <a href="add-user.php" class="btn btn-sm" style="background-color:#208de6 !important;
                                        color: rgb(243, 245, 238) !important;"><i class="fa fa-fw fa-user-plus"></i> Add User</a><br><br>
                                        
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Complete Name</th>
                                                    <th scope="col">Designation</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Date Updated</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php 
                                                $conn = new class_model();
                                                $user = $conn->fetchAll_user();
                                                $user_type_ar=array('','Administrator','Faculty','Staff');
                                                $status_ar=array('Inactive','Active');
                                               ?>
                                               <?php foreach ($user as $row) { ?>
                                                <tr>
                                                    <td><?= $row['name']; ?></td>
                                                    <td><?= $user_type_ar[$row['user_type']]; ?></td>
                                                    <td><?= $row['username']; ?></td>
                                                    <td><?= $status_ar[$row['status']]; ?></td>
                                                    <td><?= $row['date_updated']; ?></td>
                                                    <td class="align-right">
                                                        <a href="edit-user.php?user=<?= $row['id']; ?>&full-name=<?php echo $row['name']; ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                          <i class="fa fa-edit"></i>
                                                        </a> |
                                                        <a href="javascript:;" data-id="<?= $row['id']; ?>" class="text-secondary font-weight-bold text-xs delete" data-toggle="tooltip" data-original-title="Edit user">
                                                          <i class="fa fa-trash-alt"></i>
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

                var user_id = $(this).attr("data-id");
                // console.log("================get course_id================");
                // console.log(course_id);
                if (confirm("Are you sure want to remove this data?")) {
                    $.ajax({
                        url: "config/delete_user.php",
                        method: "POST",
                        data: {
                            user_id: user_id
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