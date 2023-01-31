<?php




function getRdvByMedecin($id_med, $jour, $mois,$annee) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT date_rdv FROM `rdv` where id_medecin like('".$id_med."') and DATE_FORMAT(date_rdv, \"%d/%m/%Y\") like('".$jour."/".$mois."/".$annee."')";
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
    
}

function getCreneaux($id_medecin, $jour, $mois,$annee) {

    $tab = getRdvByMedecin($id_medecin, $jour,$mois,$annee);
    $array;
	echo '<pre>';
	print_r($tab);
	echo '</pre>';
    foreach ($tab as $key => $d) {
        $date =  $d['date_rdv'];
        $date = strtotime($date);
        $array[date('H', $date)] = true;
    }
    
    for ($i=0; $i < 24; $i++) { 
        if(!isset($array[$i])) {
            $array[$i] = false;
        }
    }

    for ($i=0; $i < 24; $i++) { 
        
        echo $array[$i] ? "<div class=\"booked\" style=\"color:red;\">" : "<div>";
        echo "créneau";
        echo "</div>";
    }
} 

getCreneaux('jules.mignotte@orange.fr', '31', '01', '2023');








?>





