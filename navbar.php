<!-- Barre de navigation -->
<!-- logo from http://www.onlinewebfonts.com -->
<nav class="navbar navbar-expand-md navbar-light sticky-top border-bottom" style="background-color: #e3f2fd;">
<a href="#" class="btn btn-info" id="menu-toggle">Menu</a> 


<?php 
    //Vérifie si connecté et affiche des barres différentes si admin ou non connecté
    if(isset($_SESSION["username"])){
        echo '
        <a href="index.php" class="navbar-brand"><span>&ThinSpace;&ThinSpace;</span><img src="images/logo.png" width=40 height=34 alt="logo">Locate It</a>
        <ul class="navbar-nav ml-auto">';
        if($_SESSION["username"] == "admin"){

            echo '
            <li class="nav-item">
            <a class="nav-link" href="ban.php"><b>Bannissements </b><span>&emsp;|</span></a>
            </li>';
        }
        echo '
        <li class="nav-item">
        <a class="nav-link">Map : <b>'.transform().'</b><span>&emsp;|</span></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#">Salut <b>'.$_SESSION["username"].'</b> !</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="logout.php">Se deconnecter</a>
        </li>';
    }
    else{
        echo '
        <a href="index.php" class="navbar-brand"><span>&ThinSpace;&ThinSpace;</span><img src="images/logo.png" width=40 height=34 alt="logo">Locate It</a>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link">Map : <b>'.transform().'</b><span>&emsp;|</span></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#"><b>Guest_user</b></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="login.php">Connexion</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="inscription.php">Inscription</a>
        </li>';
    }
// fonction pour récupérer le $_GET et traduire en nom complet
    function transform(){
        if(isset($_SESSION["username"])){
            if(isset($_GET["mod"])){
                switch ($_GET["mod"]) {
                    case 'eur':
                        return "Europe";
                    case 'ame':
                        return "Amerique";
                    case 'asi':
                        return "Asie";
                    case 'oce':
                        return "Oceanie";
                    case 'afr':
                        return "Afrique";
                    case 'wor':
                        return "Monde";
                }
            }
            else{
                return "#";
            }
        }
        else{
            return "#";
        }   
    }
?>    
    
</ul>
</nav>