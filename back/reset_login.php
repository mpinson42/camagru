<?php
	include('template.php');

	if(empty($_POST['login']) || empty($_SESSION['logged_on_user']))
	{
		$msg = "param null";
		$data = [];
		reponse_json($success, $data, $msg);
		return;
	}

	$requete = $pdo->prepare("UPDATE user SET login='".$_POST['login']."' WHERE login='".$_SESSION['logged_on_user']."'");
	$_SESSION['logged_on_user'] = $_POST['login'];
	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		$success = true;
		$data['nombre'] = count($resultats);
		$data['user'] = $resultats;
	} else {
		$msg = "Une erreur s'est produite";
	}
	reponse_json($success, $data, $msg);
?>