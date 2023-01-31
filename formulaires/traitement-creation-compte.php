<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once('../functions.php');
include_once('../pdo-oracle.php');
$locationLogin = 'Location: ../login.php';
$locationCreationCompte = 'Location: formulaire-creation-compte.php';

if (!empty($_POST)) {

    if(areEmptyParameters($_POST, 'role', 'identifiant', 'password')) {

        if($_POST['passwordConfirmation']!=$_POST['password']) {
            header($locationCreationCompte);
            exit();
        }

        if(isUserUnique($_POST['identifiant'])) {
            insertUser($_POST);
        } else {
            header($locationCreationCompte);
            exit();
        }

        if($_POST['role'] == 'Patient') {
            if(areEmptyParameters($_POST, 'identifiant', 'nom', 'prenom', 'dateNaissance')) {
                insertPatient($_POST);
                header($locationLogin);
                exit();
            } else {
                header($locationCreationCompte);
                exit();
            }
        }

        if($_POST['role'] == 'Médecin') {
            if(areEmptyParameters($_POST, 'identifiant', 'nom', 'prenom', 'adresse', 'tel')) {
                insertMedecin($_POST);
                header($locationLogin);
                exit();
            } else {
                header($locationCreationCompte);
                exit();
            }
        }


    }
}
header($locationCreationCompte);
exit();

?>
