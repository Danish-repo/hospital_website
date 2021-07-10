<?php

class Database{
// used to connect to the database
private $host = "localhost";
private $db_name = DB_NAME;//"online-hospital-management-system";
private $username = DB_USER;//"root";
private $password = DB_PASS;//"";
private $con;  

public function MyDatabase(){
try {
    $this->con = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
}
  
// show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
  }
  return $this->con;
 }
}
?>