<?php
	session_start();
	include('template.php');
	$requete = $pdo->prepare("SELECT * FROM `user` WHERE `login` LIKE '".$_POST['login']."'");
	$requete->bindParam(':login', $_POST['login']);


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

	if($resultats[0]['passwd'] != hash("whirlpool", $_POST['passwd']))
	{
		print $resultats;
		$msg = "error";
		$_SESSION['logged_on_user'] = "";
	}
	else
	{
		$msg = "login";
		$_SESSION['logged_on_user'] = $_POST['login'];
		echo $_POST['login'];
	}

	reponse_json($success, $data, $msg);
?>