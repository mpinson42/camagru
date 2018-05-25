<?php
include('database.php');
header('Content-Type: application/json');


function reponse_json($success, $data, $msgErreur=NULL) {
	$array['success'] = $success;
	$array['msg'] = $msgErreur;
	$array['result'] = $data;
	if(!empty($_SESSION['logged_on_user']))
	$array['loged'] = $_SESSION['logged_on_user'];

	echo json_encode($array);
}

$requete = $pdo->prepare("DROP DATABASE api");
$requete->execute();

$requete = $pdo->prepare("CREATE DATABASE api");
$requete->execute();

$requete = $pdo->prepare("CREATE TABLE `api`.`user` ( `login` TEXT NOT NULL , `passwd` TEXT NOT NULL , `email` TEXT NOT NULL , `id` TEXT NOT NULL , `img_id` TEXT NOT NULL , `mail` INT NOT NULL ) ENGINE = InnoDB;");
$requete->execute();

$requete = $pdo->prepare("CREATE TABLE `api`.`img` ( `path` TEXT NOT NULL , `id` TEXT NOT NULL , `likedby` TEXT NOT NULL , `commentby` TEXT NOT NULL , `creat_by` TEXT NOT NULL ) ENGINE = InnoDB;");
$requete->execute();

$_SESSION['logged_on_user'] = "";