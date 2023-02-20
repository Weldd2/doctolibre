

<?php 
    session_start();
    
    include_once('functions.php');


    if(empty($_SESSION['connected'])) {
        header('Location: login.php');
    }

	include_once('head.php')


	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';

?>

