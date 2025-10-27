       <?php include('config/header.php');?>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
         <?php include('config/sidebar.php');?>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
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
                             <h2 class="pageheader-title"><i class="fa fa-fw fa-user-lock"></i> Add User </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">User</li>
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
                    include 'config/connection2.php';
                    $GET_uid = intval($_GET['user']);
                    $name = $_GET['full-name'];
                    $sql = "SELECT * FROM `users` WHERE `id`= ? AND name = ?";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("is", $GET_uid, $name);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $user_type_ar=array('','Administrator','Faculty','Staff');
                    $status_ar=array('Inactive','Active');
                    while ($row = $result->fetch_assoc()) {
                   ?>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card influencer-profile-data">
                                        <div class="card-body">
                                            <div class="" id="message1"></div>
                                            <form id="validationform" name="user_form" data-parsley-validate="" novalidate="" method="POST">
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-user"></i> User Info</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Complete Name</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" value="<?= $row['name']; ?>" name="name2" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Designation</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">

                                                    <select data-parsley-type="alphanum"  type="text" id="user_type2" name="user_type2" required="" placeholder="" class="form-control">

                                                    <option value="<?php $row['user_type'];?>"hidden>
                                                    <?php echo $user_type_ar[$row['user_type']];?></option>

                                                    <option value="1">Administrator</option>
                                                    <option value="2">Faculty</option>
                                                    <option value="3">Staff</option>
                                                    </select>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-user-lock"></i> Account Info</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Username</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" value="<?= $row['username']; ?>" name="username2" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Password</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" value="<?= $row['password']; ?>" type="password" name="password2" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                 <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Status</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                       <select data-parsley-type="alphanum" type="text" value="<?= $status_ar[$row['status']]; ?>" id="status2" required="" placeholder="" class="form-control">
                                                           <option value="<?= $row['status']; ?>" hidden><?= $status_ar[$row['status']]; ?></option>
                                                           <option value="Active" style="background-color: green;color: #fff">Active</option>
                                                           <option value="Inactive" style="background-color: red;color: #fff">Inactive</option>
                                                       </select>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-group row text-right">
                                                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                        <input name="user_id2" value="<?= $row['id']; ?>" type="hidden">
                                                        <button class="btn btn-space btn-primary" id="edit-user">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                 <?php } ?>
                            </div>
                        </div>
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
    $('#form').parsley();
    </script>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>
      <script>
          document.addEventListener('DOMContentLoaded', () => {
              let btn = document.querySelector('#edit-user');
              btn.addEventListener('click', () => {

                  const name = document.querySelector('input[name=name2]').value;
                  const user_type = $('#user_type2 option:selected').val();
                 // var b = document.getElementById('user_type').value;
                  const username = document.querySelector('input[name=username2]').value;
                  const password = document.querySelector('input[name=password2]').value;
                  const status = $('#status2 option:selected').val();
                  const id = document.querySelector('input[name=user_id2]').value;

                  var data = new FormData(this.form);

                  data.append('name', name);
                  data.append('user_type', user_type);
                  data.append('username', username);
                  data.append('password', password);
                  data.append('status', status);
                  data.append('id', id);


              if (name === '' &&  user_type ==='' && username ==='' &&  password ===''){
                      $('#message1').html('<div class="alert alert-danger"> Required All Fields!</div>');
                    }else{
                       $.ajax({
                        url: 'config/edit_user.php',
                          type: "POST",
                          data: data,
                          processData: false,
                          contentType: false,
                          async: false,
                          cache: false,
                        success: function(response) {
                          $("#message1").html(response);
                           window.scrollTo(0, 0);
                          },
                          error: function(response) {
                            console.log("Failed");
                          }
                      });
                   }

              });
          });
      </script>
</body>
 
</html>