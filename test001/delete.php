<?php
include 'tatarajah.php';
include 'Database.php';
?><!DOCTYPE HTML>
<html>
<head>
    <title>Delete Record System</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 <!-- container -->
 <div class="container">
  
  <div class="page-header">
      <h1>Delete Patient Details</h1>
  </div>
  <?php
  include 'patient.php';
  $id=isset($_GET['id_patient']) ? $_GET['id_patient'] : die('ERROR: Record ID not found.');

  $body1=new Database();
  $conn=$body1->MyDatabase();
  $body2=new patient($conn);

  $stmt=$body2->DeletePatient($id);

  ?>
</div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>