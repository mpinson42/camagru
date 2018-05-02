<?php
	session_start();
	include('template.php');

	$requete = $pdo->prepare("UPDATE user SET login='".$_POST['login']."' WHERE login='".$_SESSION['logged_on_user']."'");
	$_SESSION['logged_on_user'] = $_POST['login'];
	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		//var_dump($resultats);
		
		$success = true;
		$data['nombre'] = count($resultats);
		$data['user'] = $resultats;
	} else {
		$msg = "Une erreur s'est produite";
	}
	reponse_json($success, $data, $msg);
?>