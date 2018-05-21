<?php
	//session_start();
	include('template.php');

	if(empty($_POST['email']) || empty($_SESSION['logged_on_user']))
	{
		$msg = "param null";
		$data = [];
		reponse_json($success, $data, $msg);
		return;
	}

	$requete = $pdo->prepare("UPDATE user SET email='".$_POST['email']."' WHERE login='".$_SESSION['logged_on_user']."'");
	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		//var_dump($resultats);
		
		$success = true;
		$data['nombre'] = count($resultats);
		$msg = "succses";
	} else {
		$msg = "Une erreur s'est produite";
	}
	reponse_json($success, $data, $msg);
?>