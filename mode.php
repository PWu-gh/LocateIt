<?php 
session_start();

    require 'db_co.php';
    //tableau de tout des pays du continent
    $tableau_gen = [];
    $tableau_wiki = [];
    $continent= 0;

    //si connecté on selectionne la table contenant le continent dans $_GET
    if(isset($_SESSION["username"])){
        if (isset($_GET['mod'])) {//recupere les liens wikipedia de la table
            $rec_cont = $connect->prepare("SELECT wiki_link FROM paysinfo");
            $rec_cont->execute();
            $res = $rec_cont->fetchAll();
            $cpt = 0;
            foreach($res as $row){
                $tableau_wiki[$cpt] = $row[0];
                $cpt += 1;
            };
        } 
            
        if($_GET["mod"] == 'eur'){
            $continent= 1;

            $rec_cont = $connect->prepare("SELECT id FROM paysinfo WHERE continent = 'Europe'");
            $rec_cont->execute();
            $res = $rec_cont->fetchAll();
            $cpt = 0;
            foreach($res as $row){
                $tableau_gen[$cpt] = $row[0];
                $cpt += 1;
            };
            
            require 'carte.php';

        }
        if($_GET["mod"] == 'ame'){
            $continent= 2;
            $rec_cont = $connect->prepare("SELECT id FROM paysinfo WHERE continent = 'Americas'");
            $rec_cont->execute();
            $res = $rec_cont->fetchAll();
            $cpt = 0;
            foreach($res as $row){
                $tableau_gen[$cpt] = $row[0];
                $cpt += 1;
            };
            require 'carte.php';
        }
        if($_GET["mod"] == 'asi'){
            $continent= 3;
            $rec_cont = $connect->prepare("SELECT id FROM paysinfo WHERE continent = 'Asia'");
            $rec_cont->execute();
            $res = $rec_cont->fetchAll();
            $cpt = 0;
            foreach($res as $row){
                $tableau_gen[$cpt] = $row[0];
                $cpt += 1;
            };
            require 'carte.php';
        }
        if($_GET["mod"] == 'oce'){
            $continent= 4;
            $rec_cont = $connect->prepare("SELECT id FROM paysinfo WHERE continent = 'Oceania'");
            $rec_cont->execute();
            $res = $rec_cont->fetchAll();
            $cpt = 0;
            foreach($res as $row){
                $tableau_gen[$cpt] = $row[0];
                $cpt += 1;
            };
            require 'carte.php';
        }
        if($_GET["mod"] == 'afr'){
            $continent= 5;
            $rec_cont = $connect->prepare("SELECT id FROM paysinfo WHERE continent = 'Africa'");
            $rec_cont->execute();
            $res = $rec_cont->fetchAll();
            $cpt = 0;
            foreach($res as $row){
                $tableau_gen[$cpt] = $row[0];
                $cpt += 1;
            };
            require 'carte.php';
        }
        if($_GET["mod"] == 'wor'){
            $rec_cont = $connect->prepare("SELECT id FROM paysinfo");
            $rec_cont->execute();
            $res = $rec_cont->fetchAll();
            $cpt = 0;
            foreach($res as $row){
                $tableau_gen[$cpt] = $row[0];
                $cpt += 1;
            };
            require 'carte.php';
        }//Récupère le questionnaire customisé
        if($_GET["mod"] == 'custom' && isset($_GET["tab"])){
            $str = $_GET["tab"];
            $tableau_gen = explode(",",$str);
            require 'carte.php';
        }
    }

    
    else{//GUEST USER
        $tableau_gen = [77,130,34,45,106]; //toujours meme questionnaire
        require 'carte.php';
   }
?>
