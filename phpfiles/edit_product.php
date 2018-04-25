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
	if ($_POST['price'])
	if(intval($_POST['price']) <= 0)
	{
		echo ("ERROR\n");
		return false;
	}
	$db["products"]=edit_product($db["products"],$_POST['oldname'] ,$_POST['name'], $_POST['price'], $_POST["img"], $_POST["description"], "0.1.2.6");
}
update_database($db);
?>
