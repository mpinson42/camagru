<?php
	include('template.php');

	if(empty($_POST['str']) || (empty($_POST['id']) && $_POST['id'] != 0) )
	{
		$msg = "param null";;
		reponse_json($success, $data, $msg);
		return;
	}
	
	$requete = $pdo->prepare("UPDATE img SET likedby='".$_POST['str']."' WHERE id='".$_POST['id']."'");
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