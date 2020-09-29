<?php  

session_start();  
//redirection lorqu'on est connecté / non connecté
if(isset($_SESSION["username"])){
    // admin
    if($_SESSION["username"] == 'admin'){
    header("location:index.php");   
    }
    else{
        header("location:index.php");
    }
}  

else{  
    //si pas connecté lancer partie test
    require 'index.php';
}  


 ?>  
