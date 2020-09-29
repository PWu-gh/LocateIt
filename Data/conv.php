<?php    
          //lancer deux fois ce fichier pour le que update soit pris en compte

          $connect = mysqli_connect("localhost", "root", "", "db_carte"); //Connect PHP to MySQL Database
          $query = '';
          $cpt = 0;
          $text = '';
          $qnom = '';
          $data='';
          $npays='';

          $filename = "countries.json";
          $data = file_get_contents($filename); //Read the JSON file in PHP
          $array = json_decode($data, true); //Convert JSON String into PHP Array
          foreach($array as $row) //Extract the Array Values by using Foreach Loop
          {
            $cca = $row["cca3"];
            // $file = "paysGeo/".strtolower($row["cca3"]). ".geo.json";
            $file = "paysGeo/"."afg.geo.json";
            $fil = file_get_contents($file);
            $jdata = json_decode($fil, true);
            $gdata = json_encode($jdata);
            $npays= str_replace("'" , "\'", $row["translations"]["fra"]["common"]);// php ne lit pas ' mais \'
            //$ggdata= str_replace('"' , '\"', $gdata);
            $cpt += 1;

            $query .= "INSERT INTO paysinfo(cca3, continent) VALUES ('".$row["cca3"]."', '".$row["region"]."'); ";  // Make Multiple Insert Query 
            $qnom .= "UPDATE paysinfo SET nompays ='".$npays."' WHERE id = $cpt;";
            //$text .= "INSERT INTO paysinfo(cca3 ,contour) VALUES ('AFG', 'hgh')"; tentative raté

          }
        $q1 = mysqli_multi_query($connect, $query); //Run Mutliple Insert Query
        $q2 = mysqli_multi_query($connect, $qnom);



        echo "Database loaded";
       // lancer wiki_link.php après ce fichier
?>