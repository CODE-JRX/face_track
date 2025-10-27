<?php include('config/header.php');?>

<!-- wrapper  -->
        <!-- ============================================================== -->
  <div class="">
    <div class="container-fluid  dashboard-content">
              
<script src="jquery/jquery-3.6.0.min.js"></script>
<style>
    .loading {
        display: none;
    }
    #time_in{
        display: none;
    }
    #time_out{
        display: none;
    }

</style>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UA|FaceRec</title>
<!-- Bootstrap CSS 
<link href="bootstrap/bootstrap.min.css" rel="stylesheet">
<script src="bootstrap/bootstrap.bundle.min.js"></script>
-->
<script src="face-api/dist/face-api.js"></script>
</head>
<body>

<!-- Body Content -->
<div class="container mt-4">
<center> <video id="video" width="600" height="400" autoplay></video></center>
    <canvas id="canvas" width="640" height="480" style="display:none;"></canvas>
    <img id="photo" src="#" alt="Your captured photo will appear here." style="display:none;">
</div>
<div><center>
  <div>
<button id="capture" class="btn btn-primary btn-block">IDENTIFY</button><br>
  </div>
<div id="response"></div>
<div id="loading" class="loading">Loading...</div>

<div id ="time_btn" class="time_btn">
<button id="time_in"  class="btn btn-primary btn-block">TIME IN</button>
<button id="time_out"  class="btn btn-primary btn-block">TIME OUT</button>
</div>
</center>
</div>
<script src="script.js"></script>
</div>
  </div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
  <p>&copy; 2024 UAfrbeas.com</p>
</footer>

</body>
</html>
