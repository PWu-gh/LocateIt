<?php  
 session_start();  
 require 'db_co.php';
 
 //Si déjà connecté on relance la partie
 //Sinon on vérifie si l'identifiant et le mot de passe sont correctes
if(isset($_SESSION['username'])){
     header("location:mode.php?mod=wor");
}
else{
     try  
     {  
     $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
     if(isset($_POST["connecter"]))  
     {  
          if(empty($_POST["username"]) || empty($_POST["password"])){  
               $message = '<label>All fields are required</label>';  
          }  
          else{  
               $query = "SELECT * FROM users WHERE username = :username AND password = :password";  
               $statement = $connect->prepare($query);  
               $statement->execute(  
                    array( 'username'     =>     $_POST["username"],  
                              'password'     =>     md5($_POST["password"])));  
               $count = $statement->rowCount();  
               if($count > 0){  
                    $_SESSION["username"] = $_POST["username"];  
                    header("location:login_success.php");  
               }  
               else{  
                    $message = '<label>Wrong Data</label>';  
               }  
          }  
     }  
     }  
     catch(PDOException $error){  
          $message = $error->getMessage();  
     }
}

  
?>  

<!-- Affichage de la page en html -->
 <!DOCTYPE html>
<html lang="fr">
	<?php require 'head.php'; ?>
	<body class="back-beige">	
	<?php require 'navbar.php'; ?>
	<div id="wrapper" >
		<?php require 'sidebar.php'; ?>
        <!--page principale-->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="container">
                    <div class="row marge">
                        <div class="col-md-4"></div>
                            <div class="col-md-4">	
                              <?php  
                                   if(isset($message))  
                                   {  
                                        echo '<label class="text-danger">'.$message.'</label>';  
                                   }  
                              ?>  
                              <h3>Connexion</h3><br />  
                              <!-- formulaire de connexion -->
                              <form method="post"> 
                                   <label>Identifiant :</label>  
                                   <input type="text" name="username" class="form-control" />  
                                   <br />  
                                   <label>Mot de passe :</label>  
                                   <input type="password" name="password" class="form-control" />  
                                   <br />  
                                   <input type="submit" name="connecter" class="btn btn-info" value="Login" />  
                              </form>  

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
        <script src="Scripts/interface.js"></script>
	</body>
</html>