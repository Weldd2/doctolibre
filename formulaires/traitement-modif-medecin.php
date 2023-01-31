<?php
session_start();
include_once('../functions.php');
$locationProjet = 'Location: ../menu.php';


if (!empty($_POST)) {
    if(areEmptyParameters($_POST, 'nom', 'prenom', 'adresse', 'tel')) {
        updateMedecin($_SESSION['userId'], sansApostrophe($_POST));
    }
}
header($locationProjet);

?>
