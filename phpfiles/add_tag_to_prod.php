<?php
include_once "init.php";
include_once "db_communication.php";

$db = get_database();

require 'product.php';
require 'users.php';
require 'tags.php';
require 'orders.php';

if($_POST['submit'] === "add" && $_POST['prod_name'] && $_POST['tag_name'])
{
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , $_POST['prod_name'], $_POST['tag_name']);
}
update_database($db);
?>
