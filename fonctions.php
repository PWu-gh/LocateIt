<?php

//fonction pour récupérer le score en string et convertir en int
function getscore(){
    if(isset($_GET['score'])){
        $scoretot = (int)$_GET['score'];
        return $scoretot;
    }return false;
}

//fonction pour récupérer un string et convertir en tableau d'entier
function gettab(){
    if(isset($_GET['tab'])){
        $ss = explode(',',$_GET["tab"]);
        $compt = 0;
        foreach($ss as $cas){
            $tab_n[$compt] = (int)$cas;
            $compt += 1;
        }
    return $tab_n;    
    }return false;
}

//fonction pour récupérer l'id d'un pays et retourner le nom du pays à partir de la BDD
function convert($connect, $num){
    $recup_nom = $connect->prepare("SELECT nompays FROM paysinfo WHERE id = $num");
    $recup_nom->execute();
    $res = $recup_nom->fetch(PDO::FETCH_ASSOC);
    return $res["nompays"];

}

//fonction pour vérifier si aucune des lettres abcde sont identiques
function notequals($a, $b, $c, $d, $e){
    if($a != $b && $a != $c && $a != $d && $a != $e){
        if($b != $c && $b!=$d && $b != $e){
            if($c != $d && $c != $d){
                if($d != $e){
                    return true;
                }
            }
        }
    }
    return false;
}
?>      