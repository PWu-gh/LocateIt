<?php 
session_start();
require 'db_co.php';
include 'fonctions.php';

try  
{  //Vérifie si le bouton Creer a été appuyé
    if(isset($_POST["create"]))
    {   //Vérifie si l'utilisateur est connecté
        if(isset($_SESSION["username"])){
            if(empty($_POST["pays1"]) || empty($_POST["pays2"]) || empty($_POST["pays3"]) || empty($_POST["pays4"]) || empty($_POST["pays5"])){  
                $message = '<label>Tous champs requis</label>';  
            }
            else{
                $pays1 = $_POST["pays1"];
                $pays2 = $_POST["pays2"];
                $pays3 = $_POST["pays3"];
                $pays4 = $_POST["pays4"];
                $pays5 = $_POST["pays5"];
                $nbpays = 250;
    
                //verifie si identifiant existe deja
                $reqVer = $connect->prepare("SELECT * FROM questionnaires WHERE p1 = ? AND p2 = ? AND p3 = ? AND p4 = ? AND p5 = ?");
                $reqVer->execute(array($pays1, $pays2, $pays3, $pays4, $pays5));
                $reqExist = $reqVer->rowCount();
                if($reqExist == 0){
                        if(notequals($pays1 ,$pays2 ,$pays3, $pays4,$pays5)){
                            if($pays1 <= $nbpays && $pays2 <= $nbpays && $pays3 <= $nbpays && $pays4 <= $nbpays && $pays5<= $nbpays){
                                if($pays1 > 0 && $pays2 > 0 && $pays3 > 0 && $pays4 > 0 && $pays5 >0){
    
                                    $crea = $connect->prepare("INSERT INTO questionnaires VALUES (?, ? , ?, ?, ?, ?)");
                                    $crea->execute(array(NULL, $pays1, $pays2, $pays3, $pays4, $pays5));
                                    $message = "Questionnaire créée !";
                                    //header("location:lol.php");//A faire
                                }
                                else{
                                    $message = '<label>ID non existant petit</label>';
                                }
                            }
                            else{
                                $message = '<label>ID non existant grand</label>';
                            } 
                        }
                        else{
                            $message = '<label>Il y a deux fois le meme pays !</label>';
                        }
                }
                else{
                    $message = '<label>Questionaire déjà existant</label>';
                }
            } 
        }
        else{
            $message = '<label>Veuillez vous connecter</label>';
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
                    <br/>
                    <h2 style="text-align:center">Bienvenue à l'atelier, ici vous pouvez créer votre questionnaire</h2>
                    <br>
                    <div class="row">
                        <div class="col-md-4">

                            <h3>Entrez l'id des pays</h3><br/>  
                            <!-- formulaire pour récupérer les données entrées -->
                            <form method="post">  
                                <label>pays 1 :</label>  
                                <input type="number" name="pays1" class="form-control" />  
                                <label>pays 2 :</label>  
                                <input type="number" name="pays2" class="form-control" />  
                                <label>pays 3 :</label>  
                                <input type="number" name="pays3" class="form-control" />  
                                <label>pays 4 :</label>  
                                <input type="number" name="pays4" class="form-control" />  
                                <label>pays 5 :</label>  
                                <input type="number" name="pays5" class="form-control" />   
                                <input type="submit" name="create" class="btn btn-info" value="Creer" />  
                            </form> 
                            <br> 
                            <?php  
                                if(isset($message))  
                                {  
                                    echo '<label class="text-danger">'.$message.'</label>';  
                                }  
                            ?>  

                        </div>
                        <div class="col-md-8">
                            <div style="overflow:scroll; height:800px;">
                                <table>
                                    <h2 style="text-align:center;">Info pays</h2>
                                    <tr><th>ID&emsp;&emsp;</th><th>Nom </th><th>Continent</th></tr>
                                    <?php
                                        require 'db_co.php';
                                        //requete pour récupérer et afficher le tableau d'aide
                                        $req_t = $connect->prepare("SELECT id, nompays, continent FROM paysinfo ORDER BY id ASC LIMIT 250");
                                        $req_t->execute();
                                        while($row = $req_t->fetch(PDO::FETCH_ASSOC)){
                                            echo "<tr><td>". $row["id"] . "</td><td>". $row["nompays"] . "</td><td>". $row["continent"]. "</td></tr>";
                                        }
                                    ?>  
                                </table>  
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>	
        <script src="Scripts/interface.js"></script>
	</body>
</html>