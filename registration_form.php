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
    <form id="employeeForm" enctype="multipart/form-data" action="reg_insert.php" method="post">

    <span class="input-group-text">Last Name</span>
    <input type="text" class="form-control" id="lastname" name="lastname" oninput="convertToUpperCase('lastname')" required>
    
    <span class="input-group-text">First Name:</span>
    <input type="text" class="form-control" id="firstname" name="firstname"oninput="convertToUpperCase('firstname')" required>
    
    <span class="input-group-text">Middle Name:</span>
    <input type="text" class="form-control" id="middlename" name="middlename"oninput="convertToUpperCase('middlename')" required>
 
    <span class="input-group-text">Position:</span>
    <input type="text" class="form-control" id="position" name="position"oninput="convertToUpperCase('position')" required>
        
    <span class="input-group-text">Department:</span>
    <input type="text" class="form-control" id="department" name="department"oninput="convertToUpperCase('department')" required>
   
    <center>
      <label for="biometric">Biometric Image:</label></center><br>
      <video id="video" class="mx-auto d-block" autoplay></video><br>
      <canvas id="canvas" style="display:none;"></canvas>

      <input type="file" id="biometric" name="biometric" accept="image/*" required  style="display: block;">
        
      <center><button type="button" onclick="captureImage()" class="btn btn-primary btn-block">Capture Image</button></center><br><br>
    
      <button type="submit" class="btn btn-primary btn-block">Create New Employee Record</button>
 
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

    


    <script>
        async function Open_cam() {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');

            // Request access to the webcam
            const stream = await navigator.mediaDevices.getUserMedia({ video: true });
            video.srcObject = stream;

            // Wait for the video to load metadata
            await new Promise(resolve => video.onloadedmetadata = resolve);
            video.play();

            // Set the canvas dimensions to match the video
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Draw the video frame onto the canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

         
        }

        async function captureImage() {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');

    // Request access to the webcam
    const stream = await navigator.mediaDevices.getUserMedia({ video: true });
    video.srcObject = stream;

    // Wait for the video to load metadata
    await new Promise(resolve => video.onloadedmetadata = resolve);
    video.play();

    // Set the canvas dimensions to match the video
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    // Draw the video frame onto the canvas
    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Convert the canvas content to a Blob object
    canvas.toBlob(blob => {
        // Create a new File object from the Blob
        const file = new File([blob], 'biometric.jpg', { type: 'image/jpeg' });

        // Create a new DataTransfer object
        const dataTransfer = new DataTransfer();

        // Add the file to the DataTransfer object
        dataTransfer.items.add(file);

        // Set the files property of the input element
        document.getElementById('biometric').files = dataTransfer.files;
    }, 'image/jpeg');

    // Pause the video stream
    video.pause();
}



        // Automatically start capturing the image when the page loads
        window.onload = Open_cam;
    </script>

</div>
<!-- Footer 

<footer class="bg-dark text-white text-center py-3">
  <p>&copy; 2024 UAfrbeas.com ~JRX</p>
</footer>
-->
</body>
</html>
