<?php
include 'tatarajah.php';
include 'Database.php';
?><!DOCTYPE HTML>
<html>
<head>
    <title>Main Page System</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Mainpage Patient Details</h1>
        </div>
     
        <!-- PHP read record by ID will be here -->
 
        <!-- PHP post to update record will be here -->
 <?php
  include "patient.php";

 session_start();

if(isset($_SESSION["username"])){
$obj1=new Database();
 $conn=$obj1->MyDatabase();
 $obj2=new patient($conn);

 $action = isset($_GET['action']) ? $_GET['action'] : "";
 
 $page = isset($_GET['page']) ? $_GET['page'] : 1;
 // set records or rows of data per page
$records_per_page = 5;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// if it was redirected from delete.php
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}

echo "<ul id='navli'>";
echo "<li><a class='homered' href='logout.php'>Log Out</a></li>";
echo "</ul>";

echo "<table class='table table-hover table-responsive table-bordered'>";//start table
 
    //creating our table heading
    echo "<tr>";
        echo "<th>ID Patient</th>";
        echo "<th>Patient Name</th>";
        echo "<th>Admission Detail</th>";
        echo "<th>Description</th>";
        echo "<th>Action</th>";
    echo "</tr>";
     
    // table body will be here
    //$stmt=$obj2->ReadPatient();
    $stmt=$obj2->ReadPatient($records_per_page,$from_record_num);
    $num = $stmt->rowCount();
  
    if($num>0){   
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
    extract($row);
  
    // creating new table row per record
    echo "<tr>";
        echo "<td>{$id_patient}</td>";
        echo "<td>{$patient_name}</td>";
        echo "<td>{$admission}</td>";
        echo "<td>{$description}</td>";
        echo "<td>";
            // read one record 
            echo "<a href='read_one.php?id_patient={$id_patient}' class='btn btn-info m-r-1em'>Read</a>";
             echo" ";
            // we will use this links on next part of this post
            echo "<a href='update.php?id_patient={$id_patient}' class='btn btn-primary m-r-1em'>Edit</a>";
             echo" ";
            // we will use this links on next part of this post
            echo "<a href='#' onclick='delete_user({$id_patient});'  class='btn btn-danger'>Delete</a>";
        echo "</td>";
    echo "</tr>";

      }
    }

    else{
        echo "<div class='alert alert-info'>No patient find.</div>";
    }
echo "</table>";
echo "<center><a href='create.php' class='btn btn-primary m-r-1em'>Create new record</a></center>";
// the page where this paging is used
$page_url = "index.php?";
  
// count all products in the database to calculate total pages
$total_rows = $obj2->countpages();
  
// paging buttons here
include 'paging.php';
}
else{
	 
    header("location:login.php");  

}
?> 
 <script type='text/javascript'>
// confirm record deletion
function delete_user( id ){
     
    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok, 
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?id_patient=' + id;
    } 
}
</script>       
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>