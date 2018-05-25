<?php
	include('template.php');
	include('token.php');

	if(empty($_POST['img1']) || empty($_SESSION['logged_on_user']) || empty($_POST['checkbox']) || substr($_POST['img1'], 0, 21) != "data:image/png;base64")
	{
		$msg = "param null";
		$data = [];
		$msg = substr($_POST['img1'], 0, 21);
		reponse_json($success, $data, $msg);
		return;
	}
	//==============================================
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


	function merge_img($img1, $img2) {
		$verif = False;
		while($verif == false)
		{
			$token = token(25);
			$verif = fopen("../img/" . $token . ".png", "x");
		}

		$image_1 = imagecreatefrompng($img1);
		$image_2 = imagecreatefrompng($img2);
		imagealphablending($image_1, true);
		imagesavealpha($image_1, true);
		imagecopy($image_1, $image_2, 0, 0, 0, 0, 500, 375);
		imagepng($image_1, "../img/". $token . ".png");
		return $token;
	}


	if(empty($_POST['img1']))
	{
		return;
	}

	$data = explode(",", $_POST['img1']);
	$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['img1']));


	$img = $_POST['img1'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);


	$verif = False;


	while($verif == false)
	{
		$token = token(25);
		$verif = fopen("../img/" . $token . ".png", "x");
	}
	fwrite($verif, $data);
	fclose($verif);

	$file = getimagesize("../img/" . $token . ".png");;
	if($file['0'] != 500 || $file['1'] != 375 || $file['mime'] != "image/png")
	{
		unlink("../img/" . $token . ".png");
		$msg = "error file";
		$data = [];
		$msg = substr($_POST['img1'], 0, 21);
		reponse_json($success, $data, $msg);
		return;
	}

	if($_POST['checkbox'] == 1)
	{
		$token = merge_img("../img/" . $token . ".png", "../img/cadre.png");
	}
	else if($_POST['checkbox'] == 2)
	{
		$token = merge_img("../img/" . $token . ".png", "../img/coeur.png");
	}
	else if($_POST['checkbox'] == 3)
	{
		$token = merge_img("../img/" . $token . ".png", "../img/pizza.png");
	}
	if($_POST['gif'] == 1)
	{
		echo $token .".png";
		return;
	}
	$requete = $pdo->prepare("INSERT INTO `img` (`path`, `id`, `likedby`, `commentby`, `creat_by`) VALUES ('".$token.".png', '".$id."', '[]', '{\"comments\":[]}', '".$creat_by."');");
	

	if( $requete->execute() ){
		$success = true;
		$msg = 'user added';
	} else {

		$msg = "user fail to added";
	}








	
?>