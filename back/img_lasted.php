<?php
include('template.php');

	$requete = $pdo->prepare("SELECT * FROM `user` WHERE `login` LIKE '".$_SESSION['logged_on_user']."'");


if( $requete->execute() ){
	$resultats = $requete->fetchAll();
	
	$success = true;
	$data['nombre'] = count($resultats);
	if(!$resultats[0])
		exit();
	$data = $resultats[0];


	$id = $resultats[0]['id'];



	$requete = $pdo->prepare("SELECT * FROM `img` WHERE `creat_by` LIKE '".$id."'");



	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		$success = true;
		reponse_json($success, $resultats, 'oui');

	} else {
		$msg = "Une erreur s'est produite";
	}

} else {
	$msg = "Une erreur s'est produite";
}