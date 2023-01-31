<?php

session_destroy();
session_start();
$_SESSION['deco'] = true;
header('Location: login.php')

?>