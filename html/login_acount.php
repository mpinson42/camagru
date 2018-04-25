<?php
	session_start();
	include "../phpfiles/init.php";
	include "../phpfiles/db_communication.php";
	include '../phpfiles/auth.php';
	$db = get_database();
	if($_POST['login'] && $_POST['passwd'] && $db["users"])
	{
		if(auth($_POST['login'], $_POST['passwd'], $db["users"]))
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
