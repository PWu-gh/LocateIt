<?php   
 //on est redirigé lorqu'on appuie sur déconnexion
 session_start();  
 session_destroy();  
 header("location:mode.php");  
 ?>  