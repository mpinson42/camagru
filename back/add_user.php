<?php
session_start();
include('template.php');

if(empty($_SESSION['token']) || empty($_GET['token']) ||  $_GET['token'] != $_SESSION['token'])
{
	echo $_GET['token'] . ' ';
	echo $_SESSION['token'] . " ";
	echo 
	exit();
}

//$id = get_last_id_user();

if( !empty($_SESSION['login']) && !empty($_SESSION['passwd']) && !empty($_SESSION['email'])) {
	//Si toutes les données sont saisie par le client
	$passwd = hash('whirlpool', $_SESSION['passwd']);
	$requete = $pdo->prepare("INSERT INTO `user` (`login`, `passwd`, `email`, `id`, `img_id`) VALUES ('".$_SESSION['login']."', '".$passwd."', '".$_SESSION['email']."', '".$_SESSION['id']."', '');");
	$requete->bindParam(':login', $_SESSION['login']);
	$requete->bindParam(':passwd', $passwd);
	$requete->bindParam(':email', $_SESSION['email']);

	$requete->bindParam(':id', $_SESSION['id']);

	if( $requete->execute() ){
		$success = true;
		$msg = 'user added';
	} else {
		$msg = "user fail to added";
	}
} else {
	$msg = "Il manque des informations";
}

reponse_json($success, $data, $msg);