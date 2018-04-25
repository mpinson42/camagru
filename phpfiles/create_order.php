<?php
session_start();
include_once "init.php";
include_once "db_communication.php";

$db = get_database();

require 'product.php';
require 'users.php';
require 'tags.php';
require 'orders.php';


$order = unserialize($_POST['order']);

if($_POST['submit'] === "Commander" && $_POST['user'] && $order)
{
	$db["orders"] = create_orders($db["orders"], $_POST['user'], $order);
	$_SESSION['comande'] = "";
}

update_database($db);

?>
