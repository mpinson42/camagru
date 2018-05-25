<?php
	include('template.php');
	include('token.php');
	require('gifencode.php');
	$animation = array();
    $duree = array();
    print_r($_POST);


	$img1 = imagecreatefrompng("../img/" . $_POST['img1']);
	$img2 = imagecreatefrompng("../img/" . $_POST['img2']);
	$img3 = imagecreatefrompng("../img/" . $_POST['img3']);
	$img4 = imagecreatefrompng("../img/" . $_POST['img4']);
	$img5 = imagecreatefrompng("../img/" . $_POST['img5']);

	ob_start();
	imagegif($img1);
	$animation[] = ob_get_clean();
	$duree[] = 45;

	ob_start();
	imagegif($img2);
	$animation[] = ob_get_clean();
	$duree[] = 45;

	ob_start();
	imagegif($img3);
	$animation[] = ob_get_clean();
	$duree[] = 45;

	ob_start();
	imagegif($img4);
	$animation[] = ob_get_clean();
	$duree[] = 45;

	ob_start();
	imagegif($img5);
	$animation[] = ob_get_clean();
	$duree[] = 45;


	$gif = new GIFEncoder($animation, $duree, 0, 2, 0, 0, 0, 'bin');
	



			$requete = $pdo->prepare("SELECT * FROM `user` WHERE `login` LIKE '".$_SESSION['logged_on_user']."'");


	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		$success = true;
		$data['nombre'] = count($resultats);
		$creat_by = $resultats[0]['id'];
	} else {
		$msg = "Une erreur s'est produite";
	}
	//=====================================================

	$requete = $pdo->prepare("SELECT * FROM `img`");
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

	$id = 0;
	foreach ($resultats as $key => $value) {
		if($id >= $value['id'])
			$id = $value['id'];
		$id++;
	}

	//=====================

	$verif = False;
	while($verif == false)
	{
		$token = token(25);
		$verif = fopen("../img/" . $token . ".gif", "x");
	}
	fputs($verif, $gif->GetAnimation());
	fclose($verif);

	$requete = $pdo->prepare("INSERT INTO `img` (`path`, `id`, `likedby`, `commentby`, `creat_by`) VALUES ('".$token.".gif', '".$id."', '[]', '{\"comments\":[]}', '".$creat_by."');");
	

	if( $requete->execute() ){
		$success = true;
		$msg = 'user added';
	} else {

		$msg = "user fail to added";
	}
?>