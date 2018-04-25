<?php
	session_start();
	include('template.php');

	$requete = $pdo->prepare("UPDATE user SET email='".$_POST['email']."' WHERE login='".$_SESSION['logged_on_user']."'");
	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		//var_dump($resultats);
		
		$success = true;
		$data['nombre'] = count($resultats);
		$data['user'] = $resultats;
	} else {
		$msg = "Une erreur s'est produite";
		reponse_json($success, $data, $msg);
		exit();
	}
?>