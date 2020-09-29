<?php 
 session_start(); 
require 'db_co.php';
//Vérification des données entrées
 try  
 {  
    if(isset($_POST["valid"]))
    {
        if(empty($_POST["username"]) || empty($_POST["mdp"]) || empty($_POST["mdp2"])){  
            $message = '<label>All fields are required</label>';  
        }
        else{
            $username = htmlspecialchars($_POST['username']);
            $mdp = md5($_POST['mdp']); // hachage md5
            $mdp2 = md5($_POST['mdp2']);

            //verifie si identifiant existe deja
            $reqVer = $connect->prepare("SELECT * FROM users WHERE username = ?");
            $reqVer->execute(array($username));
            $reqExist = $reqVer->rowCount();
            if($reqExist == 0){
                    if($mdp != $mdp2){
                        $message = '<label>Mot de passe différent !</label>';
                    }
                    else{
                        // insertion d'un nouveau compte
                        $insertUser = $connect->prepare("INSERT INTO users(id, username, password) VALUES(?, ?, ?)");
                        $insertUser->execute(array(NULL, $username, $mdp));
                        header("location:login.php");
                    }
            }
            else{
                $message = '<label>Identifiant déjà utilisé</label>';
            }
        } 
    }
}  
catch(PDOException $error)  
{  
     $message = $error->getMessage();  
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
                                <h3>inscription</h3><br />  
                                <!-- formulaire pour récupérer les informations -->
                                <form method="post">  
                                    <label>Identifiant :</label>  
                                    <input type="text" name="username" class="form-control" />  
                                    <br />  
                                    <label>Mot de passe:</label>  
                                    <input type="password" name="mdp" class="form-control" />  
                                    <br /> 
                                    <label>Répétez votre mot de passe:</label>  
                                    <input type="password" name="mdp2" class="form-control" />  
                                    <br />   
                                    <input type="submit" name="valid" class="btn btn-info" value="Valider" />  
                                </form>  
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
	</div>	
        <script src="Scripts/interface.js"></script>
	</body>
</html>