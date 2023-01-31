<?php


//---------------------------------------------------------------------------------------------
function OuvrirConnexionPDO()
{
	$db = 'mysql:host=mysql-antoinenm.alwaysdata.net;dbname=antoinenm_doctolib';
	$db_username =  'antoinenm';
	$db_password = 'Tahmdf25';
	try
	{
		$conn = new PDO($db,$db_username,$db_password);
		$res = true;
	}
	catch (PDOException $erreur)
	{
		echo $erreur->getMessage();
		return -1;
	}
	return $conn;
}
//---------------------------------------------------------------------------------------------
function majDonneesPDO($conn,$sql)
{
	$stmt = $conn->exec($sql);
	return $stmt;
}
//---------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------
function LireDonneesPDO($conn,$sql,&$tab)
{
	$i=0;
	foreach  ($conn->query($sql,PDO::FETCH_ASSOC) as $ligne)     
		$tab[$i++] = $ligne;
	$nbLignes = $i;
	return $nbLignes;
}


?>