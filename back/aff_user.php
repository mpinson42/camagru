<?php
include('template.php');

if( !empty($_GET['login']) ){
	//Si le client a saisi une ville de depart, on filtre les données via MySQL
	$requete = $pdo->prepare("SELECT * FROM `user` WHERE `login` LIKE '".$_GET['login']."'");
	$requete->bindParam(':nom', $_GET['login']);
} else {
	//Sinon on affiche tous les vols
	//$requete = $pdo->prepare("SELECT * FROM `user`");
}


if( $requete->execute() ){
	$resultats = $requete->fetchAll();
	//var_dump($resultats);
	
	$success = true;
	$data['nombre'] = count($resultats);
	$data['user'] = $resultats;
} else {
	$msg = "Une erreur s'est produite";
}

reponse_json($success, $data);