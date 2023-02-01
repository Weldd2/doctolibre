<?php

include_once('pdo-oracle.php');
include_once('functions.php');

$creneaux = getAllCreneauxParCategorie(1);
$medecins = getMedecinsParCategorie(1);

$nbMedecins = count($medecins);

for($i=0;$i<$nbMedecins;$i++){
    printDiv($i,$medecins,$creneaux);
    echo "</br>";
}
?>