<?php
include('template.php');

if( !empty($_GET['login']) ){
	//Si le client a saisis un id

	$requete = $pdo->prepare("DELETE FROM `user` WHERE `login` = :login");
	$requete->bindParam(':login', $_GET['login']);

	if( $requete->execute() ){
		$success = true;
		$msg = 'Le vol est supprimé';
	} else {
		$msg = "Une erreur s'est produite";
	}
} else {
	$msg = "Il manque des informations";
}

reponse_json($success, $data, $msg);