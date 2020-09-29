<?php 
session_start();
require 'db_co.php';
include 'fonctions.php';

//si le bouton a été appuyé vérifie si c'est un admin, puis vérifie si la personne a bannir est présent dans la table, retire si oui
try  
{  
    if(isset($_POST["p_user"]))
    {
        if($_SESSION["username"] == "admin"){
            if(empty($_POST["id_u"])){  
                $message = '<label>Entrez un ID joueur à retirer</label>';  
            }
            else{
                $id_u = $_POST["id_u"];
                $reqVer = $connect->prepare("SELECT id FROM users WHERE id = $id_u");
                $reqVer->execute();
                $reqExist = $reqVer->rowCount();
                if($reqExist == 0){
                    $message = "ID invalide";
                }
                else{//retire la personne du tableau
                    $crea = $connect->prepare("DELETE FROM users WHERE id = $id_u");
                    $crea->execute();
                    $message = $id_u." à été banni !";
                }
                        
            } 
        }
        else{
            $message = '<label>Veuillez vous connecter en tant que admin</label>';
        }
    }

    //si le bouton a été appuyé vérifie si c'est un admin, puis vérifie si le questionnaire a bannir est présent dans la table, retire si oui
    if(isset($_POST["p_quest"]))
    {
        if($_SESSION["username"] == "admin"){
            if(empty($_POST["id_q"])){  
                $message = '<label>Entrez un ID questionnaire à retirer</label>';  
            }
            else{
                $id_q = $_POST["id_q"];
                $reqq = $connect->prepare("SELECT id_q FROM questionnaires WHERE id_q = $id_q");
                $reqq->execute();
                $reqExist = $reqq->rowCount();
                if($reqExist == 0){
                    $message = "Questionnaire inexistant";
                }
                else{// retire le questionnaire
                    $rem = $connect->prepare("DELETE FROM questionnaires WHERE id_q = $id_q");
                    $rem->execute();
                    $message = "Le questionnaire ".$id_q." à été retiré !";
                }
                        
            } 
        }
        else{
            $message = '<label>Veuillez vous connecter en tant que admin</label>';
        }
    }
}  
catch(PDOException $error)  
{  
    $message = $error->getMessage();  
}     
?>


<!-- page html pour l'interface de bannissement -->
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
                    <h3 style="text-align: center;">Page de Bannissement</h3><br/><br/>
                    <div class="row marge">
                        
                        <div class="col-md-4">
                            <div class="row">
                                 <!-- formulaire pour retrait de joueur -->
                                <form method="post">  
                                    <label>Entrez l'id du joueur</label>  
                                    <input type="number" name="id_u" class="form-control" />   
                                    <input type="submit" name="p_user" class="btn btn-info" value="Bannir" />  
                                </form> 
                            </div><br/>
                            <div class="row">
                            <!-- table de users -->
                                    <table>
                                    <tr><th>Joueurs</th></tr>
                                    <tr><th>ID</th><th>Pseudo</th><th>date incrit</th></tr>
                                    <?php
                                        $recup_q = $connect->prepare("SELECT * FROM users");
                                        $recup_q->execute();
                                        while($row = $recup_q->fetch(PDO::FETCH_ASSOC)){
                                            echo "<tr><td>". $row["id"] . "</td><td>". $row["username"] . "</td><td>". $row["d_insc"]. "</td></tr>";
                                        }
                                    ?>
                                    </table> 
                                

                            </div>
                        </div>
                        <div class="col-md-8">	
                            <div class="row">
                                <!-- formulaire pour retrait de questionnaire -->
                                <form method="post">  
                                    <label>Entrez l'id du questionnaire</label>  
                                    <input type="number" name="id_q" class="form-control" />   
                                    <input type="submit" name="p_quest" class="btn btn-info" value="Retirer" />  
                                </form> 
                            </div><br/>
                            <div class="row">

                                <!-- table de questionnaires -->
                                    <table style="width:1200px;">
                                    <tr><th>Questionnaires</th></tr>
                                    <tr><th>ID</th><th>Pays1</th><th>Pays2</th><th>Pays3</th><th>Pays4</th><th>Pays5</th></tr>
                                    
                                    <?php
                                        $recup_q = $connect->prepare("SELECT * FROM questionnaires");
                                        $recup_q->execute();
                                        while($row = $recup_q->fetch(PDO::FETCH_ASSOC)){
                                            echo "<tr><td>". $row["id_q"]."</td><td>". $row["p1"].": ".convert($connect , $row["p1"]) 
                                                . "</td><td>". $row["p2"].": ".convert($connect , $row["p2"])
                                                . "</td><td>". $row["p3"].": ".convert($connect , $row["p3"])
                                                . "</td><td>". $row["p4"].": ".convert($connect , $row["p4"])
                                                . "</td><td>". $row["p5"].": ".convert($connect , $row["p5"])
                                            . "</td></tr>";
                                        }
                                    ?>
                                    </table> 
                                </div>

                            
                            
                        </div>
                        <?php  
                            if(isset($message))  
                            {  
                                echo '<label class="text-danger">'.$message.'</label>';  
                            }  
                        ?> 



                           
                        </div>
                    </div>
                </div>
            </div>
        </div>	
        <script src="Scripts/interface.js"></script>
	</body>
</html>