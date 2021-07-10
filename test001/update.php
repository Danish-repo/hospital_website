<?php
include 'tatarajah.php';
include 'Database.php';
?><!DOCTYPE HTML>
<html> 
<head>
    <title>Update Patient System</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>   
<!-- container -->
<div class="container">
  
  <div class="page-header">
      <h1>Update Patient Details</h1>
  </div>
<?php
include "patient.php";

$id=isset($_GET['id_patient']) ? $_GET['id_patient'] : die('ERROR: Record ID not found.');
$obj=new Database();
$conn=$obj->MyDatabase();
$obj2=new patient($conn);

try {
    // prepare select query
    $query = "SELECT id_patient, patient_name, admission, description FROM patient WHERE id_patient =$id LIMIT 0,1";
    $stmt = $conn->prepare( $query );
     
    // this is the first question mark
    $stmt->bindParam(1, $id);
     
    // execute our query
    $stmt->execute();
     
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // values to fill up our form
    $patient_name = $row['patient_name'];
    $description = $row['description'];
    $admission = $row['admission'];
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

if(isset($_POST['submit'])){
  try{
       
       $obj2->patient_name=$_POST['patient_name'];
       $obj2->admission=$_POST['admission'];
       $obj2->description=$_POST['description'];

       if($obj2->UpdatePatient($id)){
            echo"<p>Successfully save!</p>";    
       }
       else
       echo"<p>Error occured!</p>";
      
  }
  catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id_patient={$id}");?>" method="post">
<table class='table table-hover table-responsive table-bordered'>
<tr>
 <td>Patient Name</td>
<td><input type='text' name='patient_name' value="<?php echo htmlspecialchars($patient_name, ENT_QUOTES);  ?>" class='form-control' /></td>
</tr>
<tr>
<td>Admission</td>
 <td><input type='text' name='admission' value="<?php echo htmlspecialchars($admission, ENT_QUOTES);  ?>" class='form-control' /></td>
</tr>
<tr>
<td>Description</td>
<td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
</tr>
 <tr>
 <td></td>
 <td>
<input type='submit' name='submit' value='Save Changes' class='btn btn-primary' />
<a href='index.php' class='btn btn-danger'>Back to Mainpage</a>
</td>
</tr>
</table>
</form>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
   <!-- Latest compiled and minified Bootstrap JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
   </body>
   </html>