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

?>