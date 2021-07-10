<?php
include 'tatarajah.php';
include 'Database.php';
?><!DOCTYPE html>  
 <html>  
      <head>  
           <title> Login Page</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
		   <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,400,700">
            <link rel="stylesheet" type="text/css" href="style3.css">
		   <style>
        img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
</style>
<img src="Unimas5.jpg" alt="#" class="center" >
      </head>  
	  
      <body style="border:10px solid #808080">  
      <?php
        session_start();
        include 'staff_hospital.php';

        $body1=new Database();
        $conn=$body1->MyDatabase();
         $body2=new staff_hospital($conn);

            if(isset($_POST["login"]))  
            {  
                if(empty($_POST["username"]) || empty($_POST["password"]))  
                {  
                $message = '<label>All fields are required</label>';  
                }  
                //$body2->id_patient=$_POST['id_patient'];
                //$body2->password=$_POST['password'];
                else{
                     
                    $body2->username=$_POST['username'];
                   $body2->password=$_POST['password'];

                    try{
                         $body2->login($body2->username,$body2->password);
                    }
                    catch(PDOException $exception){
                        die('ERROR: ' . $exception->getMessage());
                    }
            
              /*catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());*/
               }
            }
      ?>
	  <p id="demo"></p>

           <div class="container" style='max-width:500px; max-height:300px;' >  
		   <div class="login-box">
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
                <h3 align="">Patient Login Page</h3><br />  
                <form method="post" >  
                     <label>Username Staff HSPF</label>  
                     <input type="text" name="username" class="form-control" style="border:1px solid #808080" />   	
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="password" class="form-control" style="border:1px solid #808080" />  
                     <br />  
                     <center><input type="submit" name="login" class="btn btn-info" value="login" /></center>  
                </form>  
				
           </div>  
		   </div>
           <br />  
      </body>  
      <footer>
      <p><center>HSPF 2020. All rights reserved.</center></p>
    </footer>
 </html>  