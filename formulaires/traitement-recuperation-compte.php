<?php 
include_once('head.php');
include_once('../functions.php');



if(isUserUnique($_POST['email'])) {
    echo "l'utilisateur n'existe pas";
} else {
    
    $result = mail('a.mura27400@gmail.com','Testing 1 2 3','This is a test.');

    ?>

        <form action="" method="post">

            <label for="verifCode">Vérification code</label>
            <input type="number" name="verifCode" id="">

        </form>

    <?php
}


if(!empty($_POST['verifCode'])) {
    if($_POST['verifCode'] == '071506') {
        echo ("votre mot de passe est 1234");
    }
}


?>

