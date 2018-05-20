<?php
	include('template.php');


	//===================

	$requete = $pdo->prepare("SELECT * FROM `user`");


	if( $requete->execute() ){
		$resultats = $requete->fetchAll();
		//var_dump($resultats);
		
		$success = true;
		$data['nombre'] = count($resultats);
		$data['user'] = $resultats;
	} else {
		$msg = "Une erreur s'est produite";
	}//===============================================



	function auth($login, $mdp, $db){
		







		foreach ($db as $key => $value) {
			if($login == $value['login'] && hash("whirlpool", $mdp) == $value['passwd'])
			{
				return(1);
			}
		}
		return 0;
	}







	if($_POST['login'] && $_POST['passwd'] && $db)
	{
		if(auth($_POST['login'], $_POST['passwd'], $db))
		{
			$_SESSION['logged_on_user'] = $_POST['login'];
			echo "OK\n";
		}
		else
		{
			$_SESSION['logged_on_user'] = "";
			echo "ERROR\n";
		}
	}
	else
	{
		$_SESSION['logged_on_user'] = "";
		echo "ERROR\n";
	}
 ?>
