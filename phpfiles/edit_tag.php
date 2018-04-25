<?php
include_once "init.php";
include_once "db_communication.php";

$db = get_database();

require 'product.php';
require 'users.php';
require 'tags.php';
require 'orders.php';

if($_POST['submit'] === "OK" && $_POST['oldname'] && $_POST['name'])
{
	$db["tags"]=edit_tag($db["tags"], $_POST['oldname'] ,$_POST['name']);
}

update_database($db);

?>
