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
    $conn = OuvrirConnexionPDO();
    $req = "SELECT id_categorie, nom_categorie FROM categorie";
    LireDonneesPDO($conn, $req, $tab);
    $res = '';
    foreach($tab as $value){
        $res.= "<option value='".$value['id_categorie']."'>".$value['nom_categorie']."</option>";
    }
    return $res;
 }
 
 
 //Fonction qui renvoie un array composé de tous les médecins étant dans la catégorie passée en paramètre
 function getMedecinsParCategorie($categorie){
    $conn = OuvrirConnexionPDO();
    $req = "SELECT id_user, nom_medecin, prenom_medecin, adresse_medecin, tel_medecin FROM medecin JOIN categorie_medecin using(id_user) WHERE id_categorie = ".$categorie;
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
 }
 
 
 //Fonction qui insère un rdv dans la base de données avec les attributs passées en paramètre
 function insertRdv($id_patient, $id_medecin, $datetime){
    $conn = OuvrirConnexionPDO();
    $req = "INSERT INTO rdv VALUES(null," . $id_patient . "," . $id_medecin . ",'En attente','" . $datetime . "')";
    echo $req;
    LireDonneesPDO($conn, $req, $tab);
 }
 
 
 //Fonction qui renvoie un array composé de tous les médecins étant en attente de confirmation
 function getMedecinsEnAttente(){
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
    $conn = OuvrirConnexionPDO();
    $req = "UPDATE medecin SET etat_inscription_medecin = 'Accepté' WHERE id_user = '".$id_medecin."'";
    LireDonneesPDO($conn, $req, $tab);
    echo "Medecin Accepté!";
    return;
 }
 
 
 //Fonction qui refuse le médecin passé en paramètre
 function refuserMedecin($id_medecin){
    $conn = OuvrirConnexionPDO();
    $req = "UPDATE medecin SET etat_inscription_medecin = 'Refusé' WHERE id_user = '".$id_medecin."'";
    LireDonneesPDO($conn, $req, $tab);
    echo "Medecin Refusé!";
    return;
 }
 
 
 //Fonction qui affiche un petit formulaire qui permet d'accepter ou de refuser les rendez-vous du médecin passé en paramètre
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
 
 
 //Fonction qui renvoie un array composé de tous les rendez-vous étant en attente de confirmation du médecin passé en paramètre
 function getRdvEnAttente($id_medecin){
    $conn = OuvrirConnexionPDO();
    $req = "SELECT id_rdv, id_patient, id_medecin, etat_rdv, date_rdv FROM rdv WHERE id_medecin = ".$id_medecin;
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
 }
 
 
 //Fonction qui valide le rendez-vous passé en paramètre
 function validerRdv($id_rdv){
    $conn = OuvrirConnexionPDO();
    $req = "UPDATE rdv SET etat_rdv = 'Accepté' WHERE id_rdv = '".$id_rdv."'";
    LireDonneesPDO($conn, $req, $tab);
    echo "Rdv Accepté!";
    return;
 }
 
 
 //Fonction qui refuse le rendez-vous passé en paramètre
 function refuserRdv($id_rdv){
    $conn = OuvrirConnexionPDO();
    $req = "UPDATE rdv SET etat_rdv = 'Refusé' WHERE id_rdv = '".$id_rdv."'";
    LireDonneesPDO($conn, $req, $tab);
    echo "Rdv Refusé!";
    return;
 }
 
 
 //Fonction qui renvoie un array composé de tous les dates des rendez-vous du mois et du médecin passée en paramètre
 function getRdvs($mois, $annee, $medecin){
    $conn = OuvrirConnexionPDO();
    $req = "SELECT date_rdv FROM rdv WHERE id_medecin = '".$medecin."'";
    LireDonneesPDO($conn, $req, $tab);
    return $tab;
 }

?>