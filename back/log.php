<?php
	include('template.php');

	if(empty($_POST['login']))
	{
		$msg = "param null";
		$data = [];
		reponse_json($success, $data, $msg);
		return;
	}

	
	$requete = $pdo->prepare("SELECT * FROM `user` WHERE `login` LIKE '".$_POST['login']."'");
	$requete->bindParam(':login', $_POST['login']);


	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		//var_dump($resultats);
		
		$success = true;
		$data['nombre'] = count($resultats);
		if(empty($resultats[0]))
		{
			$msg = "error";
			reponse_json($success, $data, $msg);
			exit();
		}
		$data = $resultats[0];
	} else {
		$msg = "Une erreur s'est produite";
		reponse_json($success, $data, $msg);
		exit();

	}
	if($resultats[0]['passwd'] != hash("whirlpool", $_POST['passwd']))
	{
		$msg = "error";
		$_SESSION['logged_on_user'] = "";
	}
	else
	{
		$msg = "login";
		$_SESSION['logged_on_user'] = $_POST['login'];
	}

	reponse_json($success, $data, $msg);
?>