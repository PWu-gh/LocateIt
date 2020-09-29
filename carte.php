<!-- Page de jeu dynamique-->
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
			<!--corps de la page 2 8 2-->
			<div class="container">
				<div class="row marge">
					<!-- 1e colonne-->
					<div class="col-md-2">
						<div class="row b_menu">
							<h3>Localiser :</h3>
						</div>

						<!-- drapeau de pays a afficher dans les 5 prochaines rangées-->
						<div class="row">
							<img src="images/doorquest.jpg" id="svg1" alt="aff pays">
							<p id="paysNom1">Premier</p>
						</div>
						<div class="row">
							<br/>
							<img src="images/doorquest.jpg" id="svg2" alt="aff pays">
							<p id="paysNom2">Deuxième drapeau</p>
						</div>
						<div class="row">
							<br/>
							<img src="images/doorquest.jpg" id="svg3" alt="aff pays">
							<p id="paysNom3">Troisième drapeau</p>
							<br/>
						</div>
						<div class="row">
							<img src="images/doorquest.jpg" id="svg4" alt="aff pays">
							<p id="paysNom4">Quatrième drapeau</p>
						</div>
						<div class="row">
							<img src="images/doorquest.jpg" id="svg5" alt="aff pays">
							<p id="paysNom5">Dernier drapeau</p>
						</div>
					</div>
					<!-- 2e colonne-->
					<div class="col-md-8">
						<!-- Mettre le radar, nombre de vie, score-->
						<div class="row container cus-beige">

							<!--une colle peut a nouveau etre divisée par 12-->
							<div class="col-md-4">

								<h6>Tentatives:</h6>

								<img src="images/target.png" id="try1" alt="img">
								<img src="images/target.png" id="try2" alt="img">
								<img src="images/target.png" id="try3" alt="img">

							</div>
							<div class="col-md-4">
								<b>Score total : <span id="scoreTotal">Score</span></b>
								<br/><span>réussite : +</span>
								<span id="scoreA">Score actuel</span>	
							</div>


							<div class="col-md-4">
								<b>Coord : [ lat , lng ]</b><br/>
								<b>: [</b>
								<span id="coordx"> X</span>
								<b>,</b>
								<span id="coordy"> Y</span>
								<b>]</b>
							</div>

						</div>

						
						
							
						<!-- rangée pour mettre la carte seulement-->
						<div class="row">
							<div id="maDiv" style="width:100%; height:600px"></div>
						</div>
					</div>

						<!-- 3e colonne-->
					<div class="col-md-2">
						<div class="row b_menu">
							<h3>Outils</h3>
						</div>
						<div class="row">
						<button class="button" onclick="check_ns()"><img src="images/equator.png" width= 40 height= 38 alt="circle"> Equateur</button>
						</div>
						<div class="row">
							<button  class="button" onclick="check_eo()"><img src="images/vertical.png" width= 40 height= 38 alt="circle"> Greenwich</button>
							</div>
						<div class="row">
							<button  class="button" onclick="circle_rand()"><img src="images/circle.png" width= 40 height= 38 alt="circle"> Encercler</button>
						</div>
						<br/><br/>
						<div class="row">
							<button  class="button" onclick="activ_dist()">Distance Mode <img src="images/radar.png" width= 46 height= 46 alt="drapeau"></button>
						</div>
						<br/><br/>
						<!--abandon-->
						<div class="row">
							<button  class="button" onclick="localiser()">Localiser <br/><img src="images/white-flag.png" width= 46 height= 46 alt="drapeau"></button>
						</div>

					</div>
				</div>
				<br/><br/><br/>

		</div>
	</div>
	</div>
	</div>	

		<script type="text/javascript"> // passage par mode.php obligatoire et récupère les variables php en JS
			var tab_gen =  <?php echo json_encode($tableau_gen); ?> 
			var tab_wiki =  <?php echo json_encode($tableau_wiki); ?> 
			var continent = <?php echo $continent; ?> 
		</script> 
		<?php require 'scriptjs.php'; ?>
		<script src="Scripts/boucle.js"></script>

	</body>

</html>