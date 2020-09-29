<?php session_start();?>


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
                        <div class="col-md-2"></div>
                            <div class="col-md-8" style="overflow:scroll; height:800px;">	
                                <table>
                                    <tr><th>HISTORIQUE</th></tr>
                                    <tr><th>Joueur</th><th>Score</th><th>Questionnaire</th><th>date</th></tr>
                                    <?php
                                    
                                    require 'db_co.php';
                                    //recupere la table de l'historique
                                    $req_t = $connect->prepare("SELECT * FROM users_stats ORDER BY date_score DESC");
                                        $req_t->execute();
                                        while($row = $req_t->fetch(PDO::FETCH_ASSOC)){
                                        echo "<tr><td>". $row["username"] . "</td><td>". $row["score"] . "</td><td>". $row["questionnaire"]. "</td><td>". $row["date_score"]. "</td></tr>";
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



    