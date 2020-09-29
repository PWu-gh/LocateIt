<?php

session_start();
require 'db_co.php';
require 'fonctions.php';

$tableau_wiki = [];
$tab_n = [];
//récupère le score et le tab envoyé en get et et ajoute dans la table des stats
if(isset($_SESSION["username"]) && isset($_GET['score']) && isset($_GET['tab'])){
	$scoretot = getscore();
	$tab_n = gettab();
	$req_st = $connect->prepare("INSERT INTO users_stats(username, score, questionnaire, date_score) VALUES (?, ?, ?, ?)");
	$req_st->execute(array($_SESSION["username"], $scoretot, $_GET['tab'], NULL));
	
//prend les lien wiki
	$rec_cont = $connect->prepare("SELECT wiki_link FROM paysinfo");
	$rec_cont->execute();
	$res = $rec_cont->fetchAll();
	$cpt = 0;
	foreach($res as $row){
		$tableau_wiki[$cpt] = $row[0];
		$cpt += 1;
	};
	require 'end_page.php';

}
else{//non connecté
	header("location:mode.php");
}

		
?>

