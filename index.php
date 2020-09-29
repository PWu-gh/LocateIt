<?php
session_start();
?>
<!-- Affichage de la page d'index regle du jeu et redirections -->
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
				<div class="container"><br/>
				<hr style="width:100%;">
				<h3 style="text-align:center">Bienvenue sur Locate It</h3>
				<hr style="width:100%;"> 
				<p class="p1">Les règles du jeux sont très simples! Il suffit de cliquer sur le pays associé au drapeaux apparaissant à gauche !</p>
				<p class="p1">Vous aurez trois chances par pays, des outils d'aides seront placé à votre droite, bien sûr cela diminuera votre score! </p>
				<p class="p1">Utiliser le méridien et l'equateur vous coûtera 100 points, un encerclement généré au hasard comprenant le pays dedans 200 points.</p>
				<p class="p1">Il y a aussi le "Mode Distance" qui vous permet d'être évaluer sur la distance par rapport au pays à trouver</p>
				<p class="p1">Localiser un pays est synonyme d'abandon, vous ne gagnerez aucun points.</p>
				<p class="p1">A la fin de la partie vous aurez toutes les réponses et les informations concernant les pays. Votre score sera automatiquement enregistré et consultable dans l'historique</p>
				<p class="p1">Il est aussi possible de créer des questionnaire et jouer aux questionnaires créées. Tout cela cependant disponible celement lorsque vous êtes connecté</p>
				<p class="p1">Non connecté vous serez autamatiquement redigiré vers la même carte. Un admin pourra aussi avoir les fonctions de bannissement et de suppression des questionnaires. </p>


				<br/>
				<hr style="width:100%;">
				<h3 style="text-align:center">Mode par region</h3>
				<hr style="width:100%;">
                    <div class="row">
                        <div class="col-md-4">
							<a href="mode.php?mod=eur"><img src="images/europe.png" width="350" height="200" alt="Europe"></a>
							<h4 style="text-align:center">Europe</h4>
						</div>
						<div class="col-md-4">
							<a href="mode.php?mod=ame"><img src="images/america.png" width="350" height="200" alt="america"></a>
							<h4 style="text-align:center">Amérique</h4>
						</div>
						<div class="col-md-4">
							<a href="mode.php?mod=asi"><img src="images/asia.jpg" width="350" height="200" alt="asia"></a>
							<h4 style="text-align:center">Asie</h4>
						</div>
        
					</div><br/>
					<div class="row">
						<div class="col-md-4">
								<a href="mode.php?mod=oce"><img src="images/oceania.jpg" width="350" height="200" alt="Oceania"></a>
								<h4 style="text-align:center">Océanie</h4>
						</div>
						<div class="col-md-4">
								<a href="mode.php?mod=afr"><img src="images/africa.jpg" width="350" height="200" alt="africa"></a>
								<h4 style="text-align:center">Afrique</h4>
						</div>
						<div class="col-md-4">
								<a href="mode.php?mod=wor"><img src="images/world.png" width="350" height="200" alt="world"></a>
								<h4 style="text-align:center">Monde</h4>
						</div>
					</div><br/>
					<hr style="width:100%;">
					<h3 style="text-align:center">Autre mode</h3>
					<hr style="width:100%;">
					<div class="row">
						<div class="col-md-4">
								<a href="mode.php?mod=eur"><img src="images/atelier.jpg" width="350" height="200" alt="Oceania"></a>
								<h4 style="text-align:center">Atelier</h4>
						</div>
						<div class="col-md-4">
								<a href="mode.php?mod=eur"><img src="images/choix.jpg" width="350" height="200" alt="africa"></a>
								<h4 style="text-align:center">Questionnaires customisés</h4>
						</div>
						<div class="col-md-4">
								<a href="mode.php?mod=eur"><img src="images/historique.jpg" width="350" height="200" alt="world"></a>
								<h4 style="text-align:center">Historique</h4>
						</div>
					</div>

                    </div>
                </div>
            </div>
        </div>	
        <script src="Scripts/interface.js"></script>
	</body>
</html>