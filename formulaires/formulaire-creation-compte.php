<?php

include_once('head.php');

?>

<div class="card">
	<form action="formulaires/traitement-creation-compte.php" id="inscriptionFormulaire" method="post" class="card-body row g-3 ">
		<h1 class="h3 mb-3 fw-normal card-title">S'inscrire</h1>
		<div class="col-12">
			<select id="selectRole" name="role" class="form-select" onchange="addSelect()">
				<option selected value="">Séléctionner un rôle</option>
				<option value="Patient">Patient</option>
				<option value="Médecin">Médecine</option>
			</select>
		  </div>
	
		<div class="col-md-6">
			<label for="inputNom" class="form-label">Nom</label>
			<input type="text" class="form-control" name="nom" id="inputNom">
		</div>
		<div class="col-md-6">
			<label for="inputPrenom" class="form-label">Prénom</label>
			<input type="password" class="form-control" name="prenom" id="inputPrenom">
		</div>	
	
		<div class="col-12">
			<label for="inputIdentifiant" class="form-label">Email</label>
			<input type="email" class="form-control" name="identifiant" id="inputIdentifiant">
		</div>
		
		<div class="col-md-6">
			<label for="passwordInscription" class="form-label">Mot de passe</label>
			<input type="password" class="form-control" id="passwordInscription">
		</div>
		<div class="col-md-6">
			<label for="inputPassword4" class="form-label">Confirmation</label>
			<input type="password" name="passwordConfirmation" class="form-control" id="passwordInscriptionConfirmation">
			<span class="badge text-bg-danger mt-2" id="passwordIdentitiqueInscription" style="display: none;"></span>
		</div>

		<div class="col-12" id="patientNaissance" style="display: none">
			<label class="form-label" for="dateNaissance">Date de naissance</label>
			<input type="date" class="form-control" name="dateNaissance">
		</div>

		<div class="col-12" id="medecinFormulaireAdresse" style="display: none">
			<label class="form-label" for="adresse">Adresse</label>
			<input type="text" class="form-control" name="adresse">
		</div>
		<div class="col-12" id="medecinFormulaireTel" style="display: none">
			<label class="form-label" for="tel">Numéro de téléphone</label>
			<input type="tel" class="form-control" name="tel">
		</div>
	
		<div class="w-100">
			<input class="w-100 btn btn-primary" type="submit" id='inscriptionFormulaireSubmit' value="Envoyer" disabled="true">
		</div>
		<a class="mt-2" href="login.php">Déjà un compte ? Se connecter</a>
		<a class="mt-2" href="recuperation-compte.php">Mot de passe oublié</a>
		
	</form>
</div>


