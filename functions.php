<?php

function isUser($id, $pwd) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = 'SELECT count(*) FROM `user` WHERE ID_user = \''.$id.'\' AND password_user = \''.$pwd.'\'';
    LireDonneesPDO($conn, $req, $res);
    return $res[0]['count(*)'];
}

function isUserUnique($id) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = 'SELECT count(*) FROM `user` WHERE ID_user = \''.$id.'\'';
    LireDonneesPDO($conn, $req, $res);
    return ($res[0]['count(*)']==0);
}

function getRole($id) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = 'SELECT role_user FROM `user` WHERE ID_user = \''.$id.'\'';
    LireDonneesPDO($conn, $req, $res);
    return $res[0]['role_user'];
}

function areEmptyParameters($array, ...$strings) {
    foreach ($strings as $key => $string) {
        if(empty($array[$string])) {
            return $string;
        }
    }
    return true;
}

function insertUser($tab) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "INSERT INTO `user` (`id_user`, `password_user`, `role_user`) VALUES ('".$tab['identifiant']."', '".$tab['password']."', '".$tab['role']."')";
    majDonneesPDO($conn, $req);
}

function insertPatient($tab) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "INSERT INTO `patient` (`id_user`, `nom_patient`, `prenom_patient`, `date_naissance`) VALUES ('".$tab['identifiant']."', '".$tab['nom']."', '".$tab['prenom']."', '".$tab['dateNaissance']."')";
    majDonneesPDO($conn, $req);
}

function insertMedecin($tab) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "INSERT INTO `medecin` (`id_user`, `nom_medecin`, `prenom_medecin`, `adresse_medecin`, `tel_medecin`, `etat_inscription_medecin`) VALUES 
    ('".$tab['identifiant']."', '".$tab['nom']."', '".$tab['prenom']."', '".$tab['adresse']."', '".$tab['tel']."', 'En attente')";
    majDonneesPDO($conn, $req);
}


function getNom($id, $role) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT nom_".$role." FROM `".$role."` WHERE id_user = '".$id."'";
    LireDonneesPDO($conn, $req, $tab);
    return $tab[0]['nom_'.$role];
}

function getPrenom($id, $role) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT prenom_".$role." FROM `".$role."` WHERE id_user = '".$id."'";
    LireDonneesPDO($conn, $req, $tab);
    return $tab[0]['prenom_'.$role];
}

function getEmail($id) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT id_user FROM `medecin` WHERE id_user = '".$id."'";
    LireDonneesPDO($conn, $req, $tab);
    return $tab[0]['id_user'];
}

function getAdresse($id) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT adresse_medecin FROM `medecin` WHERE id_user = '".$id."'";
    LireDonneesPDO($conn, $req, $tab);
    return $tab[0]['adresse_medecin'];
}

function getTel($id) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT tel_medecin FROM `medecin` WHERE id_user = '".$id."'";
    LireDonneesPDO($conn, $req, $tab);
    return $tab[0]['tel_medecin'];
}

function updateMedecin($id, $tab) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "UPDATE `medecin` SET `nom_medecin` = '".$tab['nom']."', `prenom_medecin` = '".$tab['prenom']."', `adresse_medecin` = '".$tab['adresse']."', `tel_medecin` = '".$tab['tel']."' WHERE `medecin`.`id_user` = '".$id."'";
    echo $req;
    majDonneesPDO($conn, $req);
}

function updatePatient($id, $tab) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "UPDATE `patient` SET `nom_patient` = '".$tab['nom']."', `prenom_patient` = '".$tab['prenom']."' WHERE `patient`.`id_user` = '".$id."'";
    echo $req;
    majDonneesPDO($conn, $req);
}


function sansApostrophe($tab) {
    $rep = [];
    foreach ($tab as $key => $value) {
        if(preg_match('/\'/', $value)) {
            $rep[$key] = preg_replace('/\'/', '\\\'',$value);
        } else {
            $rep[$key] = $value;
        }
    }
    return $rep;
}

//Fonction qui, utilisée dans un <select> va rajouter en option, toutes les catégories de médecin
function selectToutesCategories(){
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT id_categorie, nom_categorie FROM categorie";
	echo $req;
    LireDonneesPDO($conn, $req, $tab);
    $res = '';
    foreach($tab as $value){
        $res.= "<option value='".$value['id_categorie']."'>".$value['nom_categorie']."</option>";
    }
    return $res;
 }
 
 
 //Fonction qui renvoie un array composé de tous les médecins étant dans la catégorie passée en paramètre
 function getMedecinsParCategorie($categorie){
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT id_user, nom_medecin, prenom_medecin, adresse_medecin, tel_medecin FROM medecin JOIN categorie_medecin using(id_user) WHERE id_categorie = ".$categorie;
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
 }
 
 
 //Fonction qui insère un rdv dans la base de données avec les attributs passées en paramètre
 function insertRdv($id_patient, $id_medecin, $datetime){
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "INSERT INTO rdv VALUES(null," . $id_patient . "," . $id_medecin . ",'En attente','" . $datetime . "')";
    echo $req;
    LireDonneesPDO($conn, $req, $tab);
 }
 
 
 //Fonction qui renvoie un array composé de tous les médecins étant en attente de confirmation
 function getMedecinsEnAttente(){
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT id_user, nom_medecin, prenom_medecin, adresse_medecin, tel_medecin FROM medecin WHERE etat_inscription_medecin = 'En attente'";
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
 }
 
 
 //Fonction qui affiche un petit formulaire qui permet d'accepter ou de refuser les médecins dans l'array passé en paramètre
 function afficherVerificationMedecins($tab){
    if(!empty($tab)) {
        foreach ($tab as $key => $value) {
            echo $value['prenom_medecin'] . " " . $value['nom_medecin'];
            echo "
            <form action='validerMedecinTraitement.php' method='post'>
            <input name='submitA' type='submit' value='Accepter'>
            <input name='submitR' type='submit' value='Refuser'>
            <input name='med_id' type='hidden' value='".$value['id_user']."'>
            </form>
            </br>";
        }
    }
 }
 
 
 //Fonction qui valide le médecin passé en paramètre
 function validerMedecin($id_medecin){
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "UPDATE medecin SET etat_inscription_medecin = 'Accepté' WHERE id_user = '".$id_medecin."'";
    LireDonneesPDO($conn, $req, $tab);
    echo "Medecin Accepté!";
    return;
 }
 
 
 //Fonction qui refuse le médecin passé en paramètre
 function refuserMedecin($id_medecin){
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "UPDATE medecin SET etat_inscription_medecin = 'Refusé' WHERE id_user = '".$id_medecin."'";
    LireDonneesPDO($conn, $req, $tab);
    echo "Medecin Refusé!";
    return;
 }
 
 
 
 //Fonction qui renvoie un array composé de tous les rendez-vous étant en attente de confirmation du médecin passé en paramètre
 function getRdvEnAttente($id_medecin){
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT * FROM rdv WHERE id_medecin = '".$id_medecin."' AND etat_rdv = 'En Attente'";
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
 }

  //Fonction qui renvoie un array composé de tous les rendez-vous étant en attente de confirmation du médecin passé en paramètre
  function getRdvAcceptes($id_medecin){
    include_once('pdo-oracle.php');


    $conn = OuvrirConnexionPDO();
    $req = "SELECT * FROM rdv WHERE id_medecin = '".$id_medecin."' AND etat_rdv = 'Accepté'";
	LireDonneesPDO($conn, $req, $tab);
    return $tab;
 }

 function printAllRdvAcceptes($id_medecin){
	$rdvs = getRdvAcceptes($id_medecin);

	echo "<ul class=\"list-group\">";
	foreach($rdvs as $rdv){

		echo "<li class=\"list-group-item rdvEnAttente\">";
		echo $rdv['id_patient'] ." : ". $rdv['date_rdv']." - Accepté";
		echo "</li>";
	}
 }

 function printAllRdvEnAttente($id_medecin){
	$rdvs = getRdvEnAttente($id_medecin);

	echo "<ul class=\"list-group\">";

	foreach($rdvs as $rdv){
		
		echo "<li class=\"list-group-item rdvEnAttente\">";
		echo $rdv['id_patient'] ." : ". $rdv['date_rdv'];
		echo "</br>";
		echo "<form action=\"formulaires/traitement-accepter-rdv.php\" method=\"POST\">";
		echo "<input type=\"hidden\" name=\"id_rdv\" value=\"".$rdv['id_rdv']."\"></input>";
		echo "<input type=\"submit\" class=\"btn btn-success\" name=\"btnAccepter\" value=\"Valider\"></input>";
		echo "<input type=\"submit\" class=\"btn btn-warning\" name=\"btnRefuser\" value=\"Refuser\"></input>";
		echo "</form>";
		echo "</li>";
	}
}


 
 //Fonction qui valide le rendez-vous passé en paramètre
 function validerRdv($id_rdv){
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "UPDATE rdv SET etat_rdv = 'Accepté' WHERE id_rdv = '".$id_rdv."'";
    LireDonneesPDO($conn, $req, $tab);
    echo "Rdv Accepté!";
    return;
 }
 
 
 //Fonction qui refuse le rendez-vous passé en paramètre
 function refuserRdv($id_rdv){
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "UPDATE rdv SET etat_rdv = 'Refusé' WHERE id_rdv = '".$id_rdv."'";
    LireDonneesPDO($conn, $req, $tab);
    echo "Rdv Refusé!";
    return;
 }
 
 
 //Fonction qui renvoie un array composé de tous les dates des rendez-vous du mois et du médecin passée en paramètre
 function getRdvs($mois, $annee, $medecin){
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT date_rdv FROM rdv WHERE id_medecin = '".$medecin."'";
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
 }

 function getRdv($id_rdv){
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT * FROM rdv WHERE id_rdv = '".$id_rdv."'";
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
 }

 function getPatient($id_patient){
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT * FROM patient WHERE id_user = '".$id_patient."'";
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
 }

 function getMedecin($id_medecin){
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT * FROM medecin WHERE id_user = '".$id_medecin."'";
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
 }

 function getRdvByMedecinByJour($id_med, $jour, $mois,$annee) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "SELECT date_rdv FROM `rdv` where id_medecin like('".$id_med."') and DATE_FORMAT(date_rdv, \"%d/%m/%Y\") like('".$jour."/".$mois."/".$annee."')";
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
}

 function getMaxDay($month) {
    return date("t", strtotime('2022-'.$month.'-01'));
 }
 
 function isToday($year, $month, $day) {
    $today = date('Y-m-d');
    if($day < 9) {
        $day = '0'.$day;
    }
    if(date("Y") == $year && date('m')==$month && strval(date('d'))==strval($day)) {
        return "Today";
    }
    return '';
 }
 
 function haveAnRdv($year, $month, $day, $data){
     foreach($data as $value){
         if(strtotime(date('Y-m-d',strtotime($value['date_rdv']))) == mktime(0,0,0, $month, $day, $year)){
             return  "Rdv";
         }
     }
     return '';
 }
 
function getCreneauxbyJour($id_medecin, $jour, $mois,$annee) {
    $tab = getRdvByMedecinByJour($id_medecin, $jour,$mois,$annee);
    $array;
    if(!empty($tab)){
        foreach ($tab as $key => $d) {
            $date = $d['date_rdv'];
            $date = strtotime($date);
            $array[date('H', $date)] = true;
        }
    }
    
    for ($i=9; $i < 17; $i++) { 
        if(!isset($array[$i])) {
            $array[$i] = false;
        }
    }

    return $array;
}

function isFull($id_medecin, $year, $month, $day, $data){
    $count = 0;
    $array = getCreneauxByJour($id_medecin,$day,$month,$year);
    foreach($array as $value){
        if($value == 1){$count++;}
    }
    if($count >= 8){return true;}
    return false;
 }
 
function breakWeek($year, $month, $day) {
    echo (date('l', mktime(0, 0, 0, $month, $day, $year)) == 'Monday')?'<br>':'';
}
 
function typeDay($id_medecin ,$year, $month, $day, $data){
    $typeDay = isToday($year, $month, $day);
    if($typeDay == ''){
        $typeDay = haveAnRdv($year, $month, $day, $data);
        if($typeDay == "Rdv"){
            if(isFull($id_medecin ,$year, $month, $day, $data)){$typeDay = "Full";}
        }
    }
    return $typeDay;
}

function getCreneauxSurNbJours($id_medecin,$nb){
    $array;
    $jour = getCreneauxbyJour($id_medecin, date('d'), date('m'), date('Y'));
    $array[0] = $jour;
    for($i = 1; $i < $nb; $i++){
        $jour = getCreneauxbyJour($id_medecin, date('d', strtotime('+'.$i.' day')), date('m', strtotime('+'.$i.' day')), date('Y', strtotime('+'.$i.' day')));
        array_push($array, $jour);
    }
    return $array;
}

function getAllCreneauxParCategorie($id_categorie){
    $array = array();
    $medecins = getMedecinsParCategorie($id_categorie);
    foreach($medecins as $medecin){
        $creneaux = getCreneauxSurNbJours($medecin['id_user'], 5);
        array_push($array, array($medecin['id_user'] => $creneaux));
    }
    return $array;
}

function insertAvis($tab) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "INSERT INTO `avis` (`id_medecin`, `id_patient`, `texte`) VALUES ('".$tab['id_medecin']."', '".$tab['id_patient']."', '".$tab['texte']."')";
    majDonneesPDO($conn, $req);
}

function deleteAvis($id_avis) {
    include_once('pdo-oracle.php');

    $conn = OuvrirConnexionPDO();
    $req = "DELETE FROM `avis` WHERE 'id_avis' =". $id_avis;
    majDonneesPDO($conn, $req);
}

function getMotDePasse($id_user) {
    include_once('pdo-oracle.php');
	
	$conn = OuvrirConnexionPDO();
    $req = "SELECT password_user FROM user WHERE id_user = '".$id_user."'";
    LireDonneesPDO($conn, $req, $tab);
    return (string)$tab[0]['password_user'];
}


function printAllMedecinsParCategorie($id_categorie){
    $creneaux = getAllCreneauxParCategorie($id_categorie);
    $medecins = getMedecinsParCategorie($id_categorie);
    
    $nbMedecins = count($medecins);
    
    for($i=0;$i<$nbMedecins;$i++){
        printDiv($i,$medecins,$creneaux);
    }
}

function printDiv($id_medecin, $medecins, $listeCreneaux){
    $medecin = $medecins[$id_medecin];
    $creneaux = $listeCreneaux[$id_medecin];
    include('doctodiv.php');
}


?>