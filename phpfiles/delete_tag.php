<?php
include_once "init.php";
include_once "db_communication.php";

$db = get_database();

require 'tags.php';

if($_POST['submit'] === "Delete" && $_POST['name'])
{
	$db["tags"]=delete_tag($db["tags"], $_POST['name']);
}

update_database($db);

?>
