<?php
include_once "init.php";
include_once "db_communication.php";

$db = get_database();

require 'product.php';
require 'users.php';
require 'tags.php';
require 'orders.php';

if($_POST['submit'] === "OK" && $_POST['login'] && $_POST['passwd'])
{
	$db["users"]=edit_user($db["users"], $_POST['login'], $_POST['passwd'], "", "", "", "");
}

update_database($db);

?>
