<?php
session_start();

include_once('../functions.php');
$locationLogin = 'Location: ../login.php';

$locationProjet = 'Location: ../index.php';


if (!empty($_POST)) {
    if(areEmptyParameters($_POST, 'identifiant', 'password')) {
        
        if(isUser($_POST['identifiant'], $_POST['password']) == 1) {
            $_SESSION['connected'] = true;
            $_SESSION['role'] = getRole($_POST['identifiant']);
            $_SESSION['userId'] = $_POST['identifiant'];
            $_SESSION['error'] = false;
			$_SESSION['creaCompte'] = false;
            $_SESSION['deco'] = false;
            header($locationProjet);
            exit();
        }
    }
}
session_destroy();
session_start();
$_SESSION['error'] = true;
if(areEmptyParameters($_POST, 'identifiant')) {
    $_SESSION['login'] = $_POST['identifiant'];
}
header($locationLogin);
exit();

?>
