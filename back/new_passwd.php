<?php
	session_start();
	include('template.php');
	$requete = $pdo->prepare("SELECT * FROM `user` WHERE `login` LIKE '".$_SESSION['logged_on_user']."'");
	$requete->bindParam(':nom', $_SESSION['logged_on_user']);


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

	if($resultats[0]['passwd'] != hash("whirlpool", $_POST['oldpasswd']))
	{
		print $_POST['old_passwd'];
		$msg = "error mauvais mot de pass";
	}
	else
	{
		$passwd = hash("whirlpool", $_POST['passwd']);
		$requete = $pdo->prepare("UPDATE user SET passwd='".$passwd."' WHERE login='".$_SESSION['logged_on_user']."'");
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
	}

	reponse_json($success, $data, $msg);
?>