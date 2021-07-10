<?php
include 'tatarajah.php';
include 'Database.php';
?><!DOCTYPE HTML>
<html> 
<head>
    <title>Read Patient System</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>   
<!-- container -->
<div class="container">
  
  <div class="page-header">
      <h1>Read Specific Patient Details</h1>
  </div>
<?php
include "patient.php";

 //class read_one{
$id=isset($_GET['id_patient']) ? $_GET['id_patient'] : die('ERROR: Record ID not found.');
$obj=new Database();
$conn=$obj->MyDatabase();
$obj2=new patient($conn);

$obj2->ReadOne($id);

echo "<table class='table table-hover table-responsive table-bordered'>";
    echo" <tr>";
        echo"<td>Patient ID</td>";
       echo" <td>{$obj2->id_patient}</td>";
    echo"</tr>";
    echo"<tr>";
       echo" <td>Patient Name</td>";
        echo"<td>{$obj2->patient_name}</td>";
        echo"</tr>";
        echo" <tr>";
        echo"<td>Admission</td>";
        echo"<td>{$obj2->admission}</td>";
        echo"</tr>";
        echo"<tr>";
        echo"<td>Description</td>";
        echo"<td>{$obj2->description}</td>";
        echo"</tr>";
        echo"<tr>";
        echo"<td></td>";
        echo"<td>";
        echo"<a href='index.php' class='btn btn-danger'>Back to read all patients</a>";
        echo" ";
        echo"<a href='#' class='btn btn-primary' onclick='confirm_user({$id});'>Download Patient Detail(PDF)</a>";
        echo"</td>";
        echo"</tr>";
        echo"</table>";
      
    //}
        ?>
        <script type='text/javascript'>
// confirm record deletion
function confirm_user( id ){
     
    var answer = confirm('Are you sure to print report patient?');
    if (answer){
        // if user clicked ok, 
        // pass the id to delete.php and execute the delete query
        window.location = 'generate_report.php?id_patient=' + id;
    } 
}
</script>       
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>
 

