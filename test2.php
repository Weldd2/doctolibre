<?php 
session_start();
include_once('head.php');
include_once('functions.php');

$rdv = getRdv(12);

$patient = getPatient($rdv[0]['id_patient']);

$medecin = getMedecin($rdv[0]['id_medecin']);

mail($patient[0]['id_user'],'Votre Rendez-Vous médical approche!',$patient[0]['prenom_patient'] . " , votre rendez vous médical avec " . $medecin[0]['nom_medecin'] .
 " " . $medecin[0]['prenom_medecin'] . " est pour demain " . date('H:i',strtotime($rdv[0]['date_rdv'])) . " , n'oubliez pas d'être présent.");
?>