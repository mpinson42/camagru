<?php
session_start();
$success = false;
$data = array();
include('pdo.php');

function reponse_json($success, $data, $msgErreur=NULL) {
	$array['success'] = $success;
	$array['msg'] = $msgErreur;
	$array['result'] = $data;
	if(!empty($_SESSION['logged_on_user']))
	$array['loged'] = $_SESSION['logged_on_user'];

	echo json_encode($array);
}