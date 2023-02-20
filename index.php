<?php 

session_start();

if(empty($_SESSION['connected'])) {
	header('Location: login.php');
} else {
	header('Location: home.php');
}

?>