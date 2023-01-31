<?php 

include_once('../head.php');
include_once('../functions.php');


?>

<form action="formulaires/traitement-modif-medecin.php" method="post">
            
    <label for="nom">Nom</label>
    <input name="nom" type="text" value="<?php echo getNom($_SESSION['userId'], 'medecin') ?>">

    <label for="prenom">Prénom</label>
    <input name="prenom" type="text" value="<?php echo getPrenom($_SESSION['userId'], 'medecin') ?>">

    <label for="adresse">Adresse</label>
    <input name="adresse" type="text" value="<?php echo getAdresse($_SESSION['userId']) ?>">

    <label for="tel">Téléphone</label>
    <input name="tel" type="tel" value="<?php echo getTel($_SESSION['userId']) ?>">

    <input type="submit" value="Modifier">
</form>