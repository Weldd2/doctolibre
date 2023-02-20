<?php 
	session_start();
    include_once('../functions.php');
	$locationProjet = 'Location: ../home.php';


    if(empty($_SESSION['connected'])) {
        header('Location: ../login.php');
    }

	include_once('head.php');
	
	if(isset($_POST['id_rdv'])) {
		if(isset($_POST['btnAccepter'])) {
				validerRdv($_POST['id_rdv']);
				header($locationProjet);
		}
		if(isset($_POST['btnRefuser'])) {
			refuserRdv($_POST['id_rdv']);
			header($locationProjet);
		}
		

	}

	echo "ça marche pas";	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';

?>

