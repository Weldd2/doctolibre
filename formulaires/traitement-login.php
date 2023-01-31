<?php
session_start();

include_once('../functions.php');
$locationLogin = 'Location: ../login.php';

$locationProjet = 'Location: ../index.php';

echo '<pre>';
print_r($_POST);
echo '</pre>';

if (!empty($_POST)) {
    if(areEmptyParameters($_POST, 'identifiant', 'password')) {
        
        if(isUser($_POST['identifiant'], $_POST['password']) == 1) {
            $_SESSION['connected'] = true;
            $_SESSION['role'] = getRole($_POST['identifiant']);
            $_SESSION['userId'] = $_POST['identifiant'];
            header($locationProjet);
            exit();
        }
    }
}
session_destroy();
header($locationLogin);
exit();

?>
