<?php session_start();
$_SESSION['deco'] = false;
$_SESSION['creaCompte'] = false;
?>



<!DOCTYPE html>
<html lang="fr">
    <?php include_once('head.php');?>

    <body class="signin">
        <main class="form-signup w-100 m-auto">
            <?php include_once('formulaires/formulaire-creation-compte.php'); ?>            
        </main>
    </body>

</html>