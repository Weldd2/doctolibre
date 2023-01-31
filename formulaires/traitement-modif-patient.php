<?php
session_start();
include_once('../functions.php');
$locationProjet = 'Location: ../home.php';

echo '<pre>';
print_r($_POST);
echo '</pre>';

if (!empty($_POST)) {
    if(areEmptyParameters($_POST, 'nom', 'prenom', 'adresse', 'tel')) {
        updatePatient($_SESSION['userId'], sansApostrophe($_POST));
    }
}
header($locationProjet);

?>
