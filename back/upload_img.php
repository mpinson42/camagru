<?php
	include('template.php');
	include('token.php');

	if(empty($_FILES['img1']) || empty($_SESSION['logged_on_user']) || empty($_POST['checkbox']))
	{
		$msg = "param null";
		$data = [];
		reponse_json($success, $data, $msg);
		return;
	}

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


	//==============================================
		$requete = $pdo->prepare("SELECT * FROM `user` WHERE `login` LIKE '".$_SESSION['logged_on_user']."'");


	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		//var_dump($resultats);
		
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



	

	

	if(isset($_FILES['img1']))
{ 
     $dossier = '../img/';

     $extensions = array('.png');
     $extension = strrchr($_FILES['img1']['name'], '.');
     if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
	{
    	 $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
    	 exit();
	}

	$verif = false;
	while($verif == false)
	{
		$token = token(25);
		$verif = fopen("../img/" . $token . ".png", "x");
		$fichier = $token . ".png";
	}

	fclose($verif);


     if(move_uploaded_file($_FILES['img1']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
     	echo $fichier;
        echo 'Upload effectué avec succès !';


        if(!empty($_POST['checkbox']) && $_POST['checkbox'] == 1)
		{
			$token = merge_img("../img/" . $token . ".png", "../img/cadre.png");
		}
		else if(!empty($_POST['checkbox']) && $_POST['checkbox'] == 2)
		{
			$token = merge_img("../img/" . $token . ".png", "../img/coeur.png");
		}
		else if(!empty($_POST['checkbox']) && $_POST['checkbox'] == 3)
		{
			$token = merge_img("../img/" . $token . ".png", "../img/pizza.png");
		}


		echo $token;





        $requete = $pdo->prepare("INSERT INTO `img` (`path`, `id`, `likedby`, `commentby`, `creat_by`) VALUES ('".$token.".png', '".$id."', '[]', '{\"comments\":[]}', '".$creat_by."');");
	

		if( $requete->execute() ){
			$success = true;
			echo $msg = 'user added';
		} else {

			echo $msg = "user fail to added";
		}
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}
?>