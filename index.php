<?php
    session_start();

    if(empty($_SESSION['connected'])) {
        header('Location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <?php include_once('head.php');?>

<a href="menu.php">Menu</a>
<a href="deco.php">Se déconnecter</a>