<?php
include_once "init.php";
include_once "db_communication.php";

$db = get_database();

require 'product.php';
require 'users.php';
require 'tags.php';
require 'orders.php';


if($_POST['submit'] === "delete" && $_POST['name'])
{
	$db["products"]=delete_product($db["products"],$_POST["name"]);
}
update_database($db);
?>
