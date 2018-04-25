<?php
include_once "init.php";

function	get_database()
{
	$db = unserialize(file_get_contents("../database/db"));
	return $db;
}

function	update_database($db)
{
	if ($db)
		file_put_contents("../database/db", serialize($db));
}
?>
