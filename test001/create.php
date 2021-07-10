<?php
include 'tatarajah.php';
include 'Database.php';
?><!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body>
<?php
include 'patient.php';

$obj1=new Database();
$link=$obj1->MyDatabase();
$linker=new patient($link);

if(isset($_POST['submit'])){
    try{
        $linker->id_patient=$_POST['id_patient'];
       $linker->patient_name=$_POST['patient_name'];
       $linker->admission=$_POST['admission'];
       $linker->description=$_POST['description'];

        if($linker->createRecord()){
            echo "<p>Create record succesfully!</p>";
        }
        else
        echo "<p>Error happen...";

       $allowed_ext = array("jpg" => "image/jpg",  
                            "jpeg" => "image/jpeg",  
                             "gif" => "image/gif", 
                             "png" => "image/png"); 
        $file_name = $_FILES["photo"]["name"]; 
        $file_type = $_FILES["photo"]["type"]; 
        $file_size = $_FILES["photo"]["size"]; 
      
        $target_dir = "uploads/";
        $filename = $target_dir . basename($_FILES["photo"]["name"]);
        // Verify file extension 
        $ext = pathinfo($filename, PATHINFO_EXTENSION); 
  
        if (!array_key_exists($ext, $allowed_ext))          
            die("Error: Please select a valid file format."); 
          
        // Verify file size - 2MB max 
        $maxsize = 2 * 1024 * 1024; 
  
        if ($file_size > $maxsize)          
            die("Error: File size is larger than the allowed limit.");         
      
        // Verify MYME type of the file 
        if (in_array($file_type, $allowed_ext)) 
        { 
            // Check whether file exists before uploading it 
            if (file_exists("upload/".$_FILES["photo"]["name"]))             
                echo $_FILES["photo"]["name"]." is already exists."; 
              
            else
            { 
                move_uploaded_file($_FILES["photo"]["tmp_name"],   
                           "uploads/".$_FILES["photo"]["name"]); 
                echo "Your file was uploaded successfully."; 
            }  
        }  
        else
        { 
            echo "Error: Please try again.";  
        } 

    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}

?>
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Create Patient Record</h1>
        </div>
      
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" 
        enctype="multipart/form-data">
    <table class='table table-hover table-responsive table-bordered'>
    <tr>
            <td>ID Patient</td>
            <td><input type='text' name='id_patient' class='form-control' /></td>
        </tr>     
        <tr>
            <td>Name</td>
            <td><input type='text' name='patient_name' class='form-control' /></td>
        </tr>        
        <tr>
            <td>Admission</td>
            <td><input type='text' name='admission' class='form-control' /></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>
        Select image to upload:
         <input type="file" name="photo" id="photo">
        <tr>
            <td></td>
            <td>
                <input type='submit' name='submit' value='submit' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Back to Mainpage</a>
            </td>
        </tr>
    </table>
</form>
          
    </div> <!-- end .container -->
      
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>