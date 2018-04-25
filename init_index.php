<?php
if (!file_exists("./database"))
	mkdir("./database", 0777);
if(!file_exists("./database/db"))
{
	$db = array();
	//if ($db)
	require 'phpfiles/users.php';
	$db["users"]=create_user($db["users"], "root", "root", "superadmin", "", "", "");
		file_put_contents("./database/db", serialize($db));
}

function	get_database()
{
	$db = unserialize(file_get_contents("./database/db"));
	return $db;
}

function	update_database($db)
{
	if ($db)
		file_put_contents("./database/db", serialize($db));
}
?>
