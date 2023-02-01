<?php
session_start();

include_once('../functions.php');
include_once('../pdo-oracle.php');
$locationLogin = 'Location: ../login.php';
$locationCreationCompte = 'Location: ../creation-compte.php';


if (!empty($_POST)) {
	if(areEmptyParameters($_POST, 'role', 'identifiant', 'password', 'nom', 'prenom', 'password')) {
		
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
				$_SESSION['error'] = false;
				$_SESSION['creaCompte'] = true;
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
				$_SESSION['creaCompte'] = true;
				$_SESSION['error'] = false;
                header($locationLogin);
                exit();
            } else {
                header($locationCreationCompte);
                exit();
            }
        }


    }
}
unset($_SESSION);
$_SESSION['error'] = true;
header($locationCreationCompte);
exit();

?>
