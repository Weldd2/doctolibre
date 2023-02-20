<?php 
    session_start();
    
    include_once('functions.php');


    if(empty($_SESSION['connected'])) {
        header('Location: login.php');
    }

?>
<?php include_once('head.php');?>
<body>
	<?php include_once('header.php'); ?>

	<?php if($_SESSION['role'] == 'Patient') :?>

		<div class="container text-center patient">

			<h2>Rechercher un médecin par catégorie</h2>

			<form action="" method="POST">


				<select class="form-select mb-4 mt-5" name="categorie">
					<?php echo selectToutesCategories(); ?>
				</select>

				<input type="submit" class="btn btn-primary" value="Envoyer">
			</form>


			<?php if(areEmptyParameters($_POST, 'categorie')) : ?>
			
				<?php echo printAllMedecinsParCategorie($_POST['categorie']); ?>

			<?php endif; ?>

		</div>

	<?php endif; ?>

	<?php if($_SESSION['role'] == 'Médecin') :?>

		<div class="container text-center medecin">

			<div class="rdv-accepte">
				<h3>Rendez-vous acceptés</h3>
				<?php printAllRdvAcceptes($_SESSION['userId']); ?>
			</div>
			<div class="rdv-attente">
				<h3>Rendez-vous en attente</h3>

				<?php printAllRdvEnAttente($_SESSION['userId']); ?>
			</div>

		</div>

	<?php endif; ?>
</body>
</html>


