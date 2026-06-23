<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Class Scheduler</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta content="Admin & Dashboards Template" name="description" />
  <meta content="Pixeleyez" name="author" />
  
  <!-- layout setup -->
  <script type="module" src="views/assets/dist/assets/js/layout-setup.js"></script>

  <!-- JQuery -->
  <script src="views/assets/dist/assets/js/jquery-4.0.0.min.js"></script>

  <!-- App favicon -->
  <link rel="shortcut icon" href="views/assets/dist/assets/images/favicon.png">    <!-- Picker CSS -->
  <link rel="stylesheet" href="views/assets/dist/assets/libs/air-datepicker/air-datepicker.css">

  <link rel="stylesheet" href="views/assets/dist/assets/libs/choices.js/public/assets/styles/choices.min.css">
  <!-- Simplebar Css -->
  <link rel="stylesheet" href="views/assets/dist/assets/libs/simplebar/simplebar.min.css">
  <!-- Swiper Css -->
  <link href="views/assets/dist/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet">
  <!-- Nouislider Css -->
  <link href="views/assets/dist/assets/libs/nouislider/nouislider.min.css" rel="stylesheet">
  <!-- Bootstrap Css -->
  <link href="views/assets/dist/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
  <!--icons css-->
  <link href="views/assets/dist/assets/css/icons.min.css" rel="stylesheet" type="text/css">

  <!-- Sweet Alert -->
  <link href="views/assets/dist/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
  <script src="views/assets/dist/assets/libs/sweetalert2/sweetalert2.min.js"></script>

  <!-- App Css-->
  <link href="views/assets/dist/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

  <link rel="shortcut icon" href="views/assets/dist/assets/images/favicon.png">    <link rel="stylesheet" href="views/assets/dist/assets/libs/prismjs/themes/prism-coy.min.css">

</head>

<body>
  <?php
  echo '<div id="layout-wrapper">';
    // echo '<main class="app-wrapper">';
      echo '<div class="container-fluid d-flex align-items-center justify-content-center vh-100">';
      if(isset($_GET['route'])){
        $route = $_GET['route'];
        include "views/modules/" . $route . ".php";
      }else{
        include "views/modules/school-year.php";
      }
      echo '</div>';
    // echo '</main>';
  echo '</div>';
  ?>
<!-- JAVASCRIPT -->
<script src="views/assets/dist/assets/libs/swiper/swiper-bundle.min.js"></script>
<script src="views/assets/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="views/assets/dist/assets/libs/simplebar/simplebar.min.js"></script>
<script src="views/assets/dist/assets/js/scroll-top.init.js"></script>
<!-- Datepicker Js -->
<script src="views/assets/dist/assets/libs/air-datepicker/air-datepicker.js"></script>

<script src="views/assets/dist/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

<script src="views/assets/dist/assets/libs/prismjs/prism.js"></script>

<script src="views/assets/dist/assets/js/form/forms-select.init.js"></script>


<?php
  if(isset($route)){
    $routeScripts = [
      "room-reg"=> ["room-reg.js"],
      "course-reg"=> ["course-reg.js"],
      "teacher-reg"=> ["teacher-reg.js"],
    ];

    if(array_key_exists($route, $routeScripts)){
      foreach($routeScripts[$route] as $script){
        $scriptPath = "views/js/" . $script;
        if(file_exists($scriptPath)){
          echo '<script src="/classscheduler/' . $scriptPath . '"></script>';
        }  
      }
    }
  }
?>


</body>

</html>