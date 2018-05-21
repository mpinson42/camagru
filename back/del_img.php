<?php
	include('template.php');


	$requete = $pdo->prepare("DELETE FROM `img` WHERE id='" .$_POST['img_id'] . "'");
	
	


if( $requete->execute() ){
	$resultats = $requete->fetchAll();
	//var_dump($resultats);
	
	$success = true;
	$msg = "img delet";
} else {
	$msg = "Une erreur s'est produite";
}

reponse_json($success, $data, $msg);