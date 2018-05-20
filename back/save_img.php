<?php
	include('template.php');
	include('token.php');






	//==============================================
		$requete = $pdo->prepare("SELECT * FROM `user` WHERE `login` LIKE '".$_SESSION['logged_on_user']."'");


	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		//var_dump($resultats);
		
		$success = true;
		$data['nombre'] = count($resultats);
		$creat_by = $resultats[0]['id'];
		print_r ($resultats[0]['id']);
	} else {
		$msg = "Une erreur s'est produite";
	}
	//=====================================================

	$requete = $pdo->prepare("SELECT * FROM `img`");
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


	$img = $_POST['img1']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
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
	
	$requete = $pdo->prepare("INSERT INTO `img` (`path`, `id`, `likedby`, `commentby`, `creat_by`) VALUES ('".$token.".png', '".$id."', '[]', '{\"comments\":[]}', '".$creat_by."');");
	

	if( $requete->execute() ){
		$success = true;
		echo $msg = 'user added';
	} else {

		echo $msg = "user fail to added";
	}








	
?>