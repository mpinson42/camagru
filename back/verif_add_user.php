<?php
	session_start();
	include('template.php');
	include('token.php');

	$requete = $pdo->prepare("SELECT * FROM `user`");
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

	$id = 0;
	foreach ($resultats as $key => $value) {
		//print
		if ($_POST['login'] == $value['login'])
		{
			$msg = "le login existe deja";
			reponse_json($success, $data, $msg);
			exit();
		}
		if($id >= $value['id'])
			$id = $value['id'];


		$id++;
	}

	$_SESSION['login'] = $_POST['login'];
	$_SESSION['passwd'] = $_POST['passwd'];
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['id'] = $id;
	$_SESSION['token'] = token(25);
	$_SESSION['connect'] = 0;
	

	//mail($_POST['email'],"connection","http://localhost/camagru/back/add_user.php?token=".$_SESSION['token']);
	echo "http://localhost/camagru/back/add_user.php?token=".$_SESSION['token'];

?>
