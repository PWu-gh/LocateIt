<?php  
 $host = "localhost";  
 $username = "root";  
 $password = "";  
 $database = "db_carte";  
 $message = "";  


//configuration PDO pour se connecter à la BDD
try{  
    $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
}
    catch(PDOException $error)  
{  
    $message = $error->getMessage();  
}   
?>