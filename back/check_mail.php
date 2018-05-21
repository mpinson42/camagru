<?php
	include('template.php');
	
	if(empty($_SESSION['logged_on_user']) || empty($_POST['check']))
	{
		$msg = "param null";
		$data = [];
		reponse_json($success, $data, $msg);
		return;
	}

	if($_POST['check'] == "1")
	{
		$requete = $pdo->prepare("UPDATE user SET mail='0' WHERE login='".$_SESSION['logged_on_user']."'");
	}
	else
	{
		$requete = $pdo->prepare("UPDATE user SET mail='1' WHERE login='".$_SESSION['logged_on_user']."'");
	}

	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		//var_dump($resultats);
		
		$success = true;
		$data['nombre'] = count($resultats);
		$msg = "changer ok";
	} else {
		$msg = "Une erreur s'est produite";
	}
	reponse_json($success, $data, $msg);