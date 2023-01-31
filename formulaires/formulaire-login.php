
<form action="formulaires/traitement-login.php" method="post">
	<img class="mb-4" src="ressources/logo-blue.svg" alt="" height="100">
	<h1 class="h3 mb-3 fw-normal">Se connecter</h1>
	
	<?php if(isset($_SESSION['error']) && $_SESSION['error'] == true) : ?>
	<div class="alert alert-danger" role="alert">
  		Nom d'utilisateur/mot de passe invalide
	</div>
	<?php endif ?>

	<?php if(isset($_SESSION['deco']) && $_SESSION['deco'] == true) : ?>
	<div class="alert alert-success" role="alert">
  		Vous avez été déconnecté
	</div>
	<?php endif ?>

	<div class="form-floating">
		<input name="identifiant" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" <?php echo (isset($_SESSION['login']) ? "value=\"".$_SESSION['login']."\"" : '') ?> >
		<label for="floatingInput">Adresse email</label>
	</div>
	<div class="form-floating">
		<label for="floatingPassword">Mot de passe</label>
		<input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
		
	</div>

	<input class="w-100 btn btn-lg btn-primary mb-2" type="submit" value="Envoyer">
	<a class="mt-2" href="creation-compte.php">Pas de compte ? S'inscrire</a>
	<p class="mt-2 text-muted">© 2023</p>
</form>

