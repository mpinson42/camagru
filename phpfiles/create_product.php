<?php
include_once "init.php";
include_once "db_communication.php";

$db = get_database();

require 'product.php';
require 'users.php';
require 'tags.php';
require 'orders.php';

if($_POST['submit'] === "OK" && $_POST['name'] && $_POST['img'] && $_POST['price'])
{
	if(intval($_POST['price']) <= 0)
	{
		echo ("ERROR\n");
		return false;
	}
	$db["products"]=create_product($db["products"], $_POST['name'], $_POST['price'], $_POST["img"], $_POST["description"]);
}
update_database($db);
?>
