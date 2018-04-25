<?php
include_once "init.php";
include_once "db_communication.php";

$db = get_database();

require 'users.php';
require 'tags.php';

if($_POST['submit'] === "Delete" && $_POST['name'])
{
	$db["users"]=delete_user($db["users"], $_POST['name']);
}

update_database($db);

?>
