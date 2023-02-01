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

		<div class="container text-center">

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

	<?php if($_SESSION['role'] == 'Medecin') :?>


		<div class="container text-center">

			<div class="rdv-accepte">
				<ul></ul>
			</div>
			<div class="rdv-attente">

			</div>

		</div>

	<?php endif; ?>
</body>
</html>


