<?php
session_start();
require 'db_co.php';
include 'fonctions.php';

$tab_var=[];

try  
 {  
     //Verifie si le bouton à été appuyé
    if(isset($_POST["recup"]))
    {
        if(empty($_POST["id_p"])){  
            $message = '<label>entrez un id</label>';  
        }
        else{//récupère les données entrés par l'utilisateur dans le formulaire et vérifie si le questionnaire existe dans la BDD
            $id_quest = $_POST["id_p"];
            $reqVer = $connect->prepare("SELECT * FROM questionnaires WHERE id_q = ?");
            $reqVer->execute(array($id_quest));
            $reqExist = $reqVer->rowCount();
            

            if($reqExist == 0 ||$id_quest < 1 ){
                $message = '<label>ID invalide</label>';
            }
            else{
                // insertion d'un nouveau compte
                $insertUser = $connect->prepare("SELECT p1,p2,p3,p4,p5 FROM questionnaires WHERE id_q = $id_quest");
                $insertUser->execute();
                $res_q = $insertUser->fetch(PDO::FETCH_ASSOC);
                $str_tab = implode(",",$res_q);
                header('location:mode.php?mod=custom&&tab='.$str_tab);
                
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

    <style>
    
    </style>

	<div id="wrapper" >
		<?php require 'sidebar.php'; ?>
        <!--page principale-->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                    <div class="container">
                    <br/>
                    <!-- formulaire pour récupérer le questionnaire -->
                    <h2 style="text-align:center">ici vous pouvez choisir un questionnaire déjà créée</h2><br/>
                    <div class="row">
                        <div class="col-md-3">
                            <form method="post" style="margin: 0; padding: 0;"> 
                            <tr>
                                <th>
                                    <input type="number" name="id_p" class="form-control" placeholder="ID du questionnaire à lancer" style="display: inline;"/>
                                </th>  
                            <th>
                            <input type="submit" name="recup" class="btn btn-info" value="jouer" style="display: inline;"/>   
                            </th>
                        </tr>  
                                

                            </form>
                        </div>
                    </div><br/>

                    <div class="row">

                        <div class="col-md-12">

                            <table style="width:1200px;">
                                <tr><th>Questionnaires</th></tr>
                                <tr><th>ID</th><th>Pays1</th><th>Pays2</th><th>Pays3</th><th>Pays4</th><th>Pays5</th></tr>
                                <?php
                                    $recup_q = $connect->prepare("SELECT * FROM questionnaires");
                                    $recup_q->execute();
                                    //Requete pour récupérer les données du tableau 
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
                    
        </div>	
        <script src="Scripts/interface.js"></script>
	</body>
</html>