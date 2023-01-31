<?php 

include_once('../head.php');
include_once('../functions.php');


?>

<form action="formulaires/traitement-modif-patient.php" method="post">
            
    <label for="nom">Nom</label>
    <input name="nom" type="text" value="<?php echo getNom($_SESSION['userId'], 'patient') ?>">

    <label for="prenom">Prénom</label>
    <input name="prenom" type="text" value="<?php echo getPrenom($_SESSION['userId'], 'patient') ?>">

    <input type="submit" value="Modifier">
</form>