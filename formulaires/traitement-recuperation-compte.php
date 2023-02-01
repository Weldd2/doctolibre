<?php 
session_start();
include_once('head.php');
include_once('../functions.php');



if(!empty($_POST['verifCode'])) {

    if($_POST['verifCode'] == $_SESSION['code']) {
        echo ("votre mot de passe est ".getMotDePasse($_POST['email']));
    } else {
		echo "Code erroné";
	}
} else {
	if(isUserUnique($_POST['email'])) {
		echo "l'utilisateur n'existe pas";
	} else {
		$code = strval(random_int(100000, 999999));
		$_SESSION['code'] = $code;
		$result = mail($_POST['email'],'Tentative de récupération de compte Doctolibre',
		'Si vous n\'êtes pas à l\'origine de cette manipulation, quelqu\'un essaye peut-être de vous subtiliser votre compte
		Votre token de connexion :'.$code);
	
		?>
	
			<form action="" method="post">
				<label for="verifCode">Vérification code</label>
				<input type="number" name="verifCode" id="">
				<input type="hidden" name="email" value="<?php echo $_POST['email'];?>">
				<input type="submit" value="Envoyer">
			</form>
	
		<?php
	}
}






?>

