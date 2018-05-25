<?php
include('template.php');


	$requete = $pdo->prepare("SELECT * FROM `img` ");
	


if( $requete->execute() ){
	$resultats = $requete->fetchAll();
	$success = true;
	$data['nombre'] = count($resultats);
	$data['img'] = $resultats;
	$msg = "Une erreur s'est produite";
} else {
	$msg = "Une erreur s'est produite";
}

reponse_json($success, $data);