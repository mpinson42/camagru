<?php
	session_start();
	include('template.php');
	include('token.php');
	$requete = $pdo->prepare("SELECT * FROM `user` WHERE `login` LIKE '".$_POST['login']."'");
	$requete->bindParam(':nom', $_POST['login']);


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

	$token = token(25);
	//mail($_POST['email'],"connection","http://localhost/camagru/back/add_user.php?token=".$_SESSION['token']);
	echo $token;


	$passwd = hash("whirlpool", $token);
	$requete = $pdo->prepare("UPDATE user SET passwd='".$passwd."' WHERE login='".$_POST['login']."'");
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

	//reponse_json($success, $data, $msg);
?>