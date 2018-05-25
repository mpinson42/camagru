<?php
	include('template.php');
	include('token.php');


	if(empty($_POST['login']) || empty($_SESSION['logged_on_user']))
	{
		$msg = "param null";
		$data = [];
		reponse_json($success, $data, $msg);
		return;
	}

	
	$requete = $pdo->prepare("SELECT * FROM `user` WHERE `login` LIKE '".$_POST['login']."'");
	$requete->bindParam(':nom', $_POST['login']);


	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		$success = true;
		$data['nombre'] = count($resultats);
		if(empty($resultats[0]))
		{
			$msg = "Une erreur s'est produite";
			reponse_json($success, $data, $msg);
			exit();
		}
		$data = $resultats[0];
	} else {
		$msg = "Une erreur s'est produite";
		reponse_json($success, $data, $msg);
		exit();

	}

	$token = token(25);
	mail($data['email'],"new_mdp","your new mdp is ".$token);
	echo $token;

	$data = [];
	$passwd = hash("whirlpool", $token);
	$requete = $pdo->prepare("UPDATE user SET passwd='".$passwd."' WHERE login='".$_POST['login']."'");
	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		$success = true;
		$data['nombre'] = count($resultats);
		$data['user'] = $resultats;
	} else {
		$msg = "Une erreur s'est produite";
		reponse_json($success, $data, $msg);
		exit();
	}
	$data['token'] = $token;
	$msg = $token;
	reponse_json($success, $data, $msg);
?>