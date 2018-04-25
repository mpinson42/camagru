<?php
if (!file_exists("../database"))
	mkdir("../database", 0777);
if(!file_exists("../database/db"))
{
	require 'users.php';
	$db = array();
	$db["users"]=create_user($db["users"], "root", "root", "superadmin", "", "", "");
	file_put_contents("../database/db", serialize($db));
}
?>
