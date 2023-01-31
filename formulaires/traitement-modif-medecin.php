<?php
session_start();
include_once('../functions.php');
$locationProjet = 'Location: ../home.php';


if (!empty($_POST)) {
    if(areEmptyParameters($_POST, 'nom', 'prenom', 'adresse', 'tel')) {
        updateMedecin($_SESSION['userId'], sansApostrophe($_POST));
    }
}
header($locationProjet);

?>
