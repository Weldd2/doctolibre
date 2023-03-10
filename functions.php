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

//Fonction qui, utilis??e dans un <select> va rajouter en option, toutes les cat??gories de m??decin
function selectToutesCategories(){
    $conn = OuvrirConnexionPDO();
    $req = "SELECT id_categorie, nom_categorie FROM categorie";
    LireDonneesPDO($conn, $req, $tab);
    $res = '';
    foreach($tab as $value){
        $res.= "<option value='".$value['id_categorie']."'>".$value['nom_categorie']."</option>";
    }
    return $res;
 }
 
 
 //Fonction qui renvoie un array compos?? de tous les m??decins ??tant dans la cat??gorie pass??e en param??tre
 function getMedecinsParCategorie($categorie){
    $conn = OuvrirConnexionPDO();
    $req = "SELECT id_user, nom_medecin, prenom_medecin, adresse_medecin, tel_medecin FROM medecin JOIN categorie_medecin using(id_user) WHERE id_categorie = ".$categorie;
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
 }
 
 
 //Fonction qui ins??re un rdv dans la base de donn??es avec les attributs pass??es en param??tre
 function insertRdv($id_patient, $id_medecin, $datetime){
    $conn = OuvrirConnexionPDO();
    $req = "INSERT INTO rdv VALUES(null," . $id_patient . "," . $id_medecin . ",'En attente','" . $datetime . "')";
    echo $req;
    LireDonneesPDO($conn, $req, $tab);
 }
 
 
 //Fonction qui renvoie un array compos?? de tous les m??decins ??tant en attente de confirmation
 function getMedecinsEnAttente(){
    $conn = OuvrirConnexionPDO();
    $req = "SELECT id_user, nom_medecin, prenom_medecin, adresse_medecin, tel_medecin FROM medecin WHERE etat_inscription_medecin = 'En attente'";
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
 }
 
 
 //Fonction qui affiche un petit formulaire qui permet d'accepter ou de refuser les m??decins dans l'array pass?? en param??tre
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
 
 
 //Fonction qui valide le m??decin pass?? en param??tre
 function validerMedecin($id_medecin){
    $conn = OuvrirConnexionPDO();
    $req = "UPDATE medecin SET etat_inscription_medecin = 'Accept??' WHERE id_user = '".$id_medecin."'";
    LireDonneesPDO($conn, $req, $tab);
    echo "Medecin Accept??!";
    return;
 }
 
 
 //Fonction qui refuse le m??decin pass?? en param??tre
 function refuserMedecin($id_medecin){
    $conn = OuvrirConnexionPDO();
    $req = "UPDATE medecin SET etat_inscription_medecin = 'Refus??' WHERE id_user = '".$id_medecin."'";
    LireDonneesPDO($conn, $req, $tab);
    echo "Medecin Refus??!";
    return;
 }
 
 
 //Fonction qui affiche un petit formulaire qui permet d'accepter ou de refuser les rendez-vous du m??decin pass?? en param??tre
 function afficherRdvEnAttente($id_medecin){
    $tab = getRdvEnAttente($id_medecin);
    if (!empty($tab)) {
        foreach ($tab as $key => $value) {
            echo $value['id_rdv'] . " " . $value['date_rdv'];
            echo "
            <form action='validerRdvTraitement.php' method='post'>
                <input name='submitA' type='submit' value='Accepter'>
                <input name='submitR' type='submit' value='Refuser'>
                <input name='rdv_id' type='hidden' value='".$value['id_rdv']."'>
                </form>
                </br>";
            }
    }
 }
 
 
 //Fonction qui renvoie un array compos?? de tous les rendez-vous ??tant en attente de confirmation du m??decin pass?? en param??tre
 function getRdvEnAttente($id_medecin){
    $conn = OuvrirConnexionPDO();
    $req = "SELECT id_rdv, id_patient, id_medecin, etat_rdv, date_rdv FROM rdv WHERE id_medecin = ".$id_medecin;
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
 }
 
 
 //Fonction qui valide le rendez-vous pass?? en param??tre
 function validerRdv($id_rdv){
    $conn = OuvrirConnexionPDO();
    $req = "UPDATE rdv SET etat_rdv = 'Accept??' WHERE id_rdv = '".$id_rdv."'";
    LireDonneesPDO($conn, $req, $tab);
    echo "Rdv Accept??!";
    return;
 }
 
 
 //Fonction qui refuse le rendez-vous pass?? en param??tre
 function refuserRdv($id_rdv){
    $conn = OuvrirConnexionPDO();
    $req = "UPDATE rdv SET etat_rdv = 'Refus??' WHERE id_rdv = '".$id_rdv."'";
    LireDonneesPDO($conn, $req, $tab);
    echo "Rdv Refus??!";
    return;
 }
 
 
 //Fonction qui renvoie un array compos?? de tous les dates des rendez-vous du mois et du m??decin pass??e en param??tre
 function getRdvs($mois, $annee, $medecin){
    $conn = OuvrirConnexionPDO();
    $req = "SELECT date_rdv FROM rdv WHERE id_medecin = '".$medecin."'";
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
?>