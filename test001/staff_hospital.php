<?php

class staff_hospital{

public $link;

    public function __construct($conn){
        $this->link=$conn;
    }

    public function login($user,$password){
    
        $query = "SELECT * FROM staff_hospital WHERE username =:username AND password =:password";  
        $statement = $this->link->prepare($query);  
        $statement->execute(  
             array(  
                  'username'     =>     $user,  
                  'password'     =>     $password  
             )  
        );  
        $count = $statement->rowCount();  
        if($count > 0)  
        {  
             $_SESSION["username"] = $_POST['username'];  
             header("location:index.php");  
        }  
        else  
        {  
             $message = '<label>Wrong Data</label>';  
        }  
        return $statement;
 
}

}
?>