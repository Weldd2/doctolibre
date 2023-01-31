<?php 
    session_start();
    include_once('head.php');
    include_once('functions.php');
?>


<?php if(areEmptyParameters($_SESSION, 'role', 'userId')) : ?>
    <?php if($_SESSION['role'] == 'Médecin') :  ?>
        <?php include_once('formulaires/formulaire-modif-medecin.php'); ?>
    <?php endif ?>

    <?php if($_SESSION['role'] == 'Patient') :  ?>
        <?php include_once('formulaires/formulaire-modif-patient.php'); ?>
    <?php endif ?>
<?php endif ?>

<a href="index.php">Menu principal</a>