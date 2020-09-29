<?php
$link = "https://fr.wikipedia.org/wiki/";
$connect = mysqli_connect("localhost", "root", "", "db_carte");
$req = "SELECT nompays FROM paysinfo";  
$array = [];
$qlink = '';
$cpt = 0;
// on envoie la requête
$res = $connect->query($req);

while ($data = mysqli_fetch_array($res)) {
    $noapo = str_replace("'", "\'", $data[0]);
    $nospace = str_replace(' ', '_', $noapo);
    $linkcat = $link.$nospace;
    // ajoute les liens dans un tableau
    $cpt = $cpt +1 ;
    $qlink .= "UPDATE paysinfo SET wiki_link = '".$linkcat."' WHERE id = $cpt;";
}
mysqli_multi_query($connect, $qlink);

echo "Wiki links updated";
?>