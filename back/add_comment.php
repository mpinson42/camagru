<?php
	include('template.php');
	
	if((empty($_POST['id']) && $_POST['id'] != 0) || empty($_POST['str']))
	{
		$msg = "param null";
		$data = [];
		reponse_json($success, $data, $msg);
		return;
	}
	//======================================
	$requete = $pdo->prepare("SELECT * FROM `user`");
	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		$success = true;
		$users = $resultats;
	} else {
		$msg = "Une erreur s'est produite";
		reponse_json($success, $data, $msg);
		exit();
	}
	//=================================================

	$requete = $pdo->prepare("SELECT * FROM `img` WHERE `id` LIKE '".$_POST['id']."'");
	
	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		$success = true;
		$img = $resultats[0];
	} else {
		$msg = "Une erreur s'est produite";
	}

	//==================================================
	$requete = $pdo->prepare("SELECT * FROM `user` WHERE `login` LIKE '".$_SESSION['logged_on_user']."'");
	
	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		$success = true;
		$user = $resultats[0];
	} else {
		$msg = "Une erreur s'est produite";
	}
	//====================================================================
	$valid = "0";
	foreach ($users as $key => $value) {
		if($value['id'] == $img['creat_by'])
		{
			$mail = $value['email'];
			$valid = $value['mail'];
			$poster = $user['login'];
		}
	}

	if($valid == "1")
		mail($mail,"commentaire", $poster . " a commenter votre photo");

	$requete = $pdo->prepare("UPDATE img SET commentby='".$_POST['str']."' WHERE id='".$_POST['id']."'");
	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		$success = true;
		$data['nombre'] = count($resultats);
		$msg = "succses";
	} else {
		$msg = "Une erreur s'est produite";
	}
	reponse_json($success, $data, $msg);
?>