<?php
	//session_start();
	include('template.php');
	
	$requete = $pdo->prepare("UPDATE img SET commentby='".$_POST['str']."' WHERE id='".$_POST['id']."'");
	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		//var_dump($resultats);
		
		$success = true;
		$data['nombre'] = count($resultats);
		$msg = "succses";
	} else {
		$msg = "Une erreur s'est produite";
	}
	reponse_json($success, $data, $msg);
?>