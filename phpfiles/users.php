<?php
function	create_user($users, $name, $pass, $roles, $email, $home_address, $cb)
{
	if ($users)
	{
		foreach($users as $val)
		{
			if ($val["username"] === $name)
			{
				echo "Username already exists\n";
				return $users;
			}
		}
	}
	$user["username"] = $name;
	$user["pass"] = hash("whirlpool", $pass);
	$user["email"] = $email;
	$user["address"] = $home_address;
	$user["role"] = $roles;
	$user["cb"] = $cb;
	$users[]=$user;
	echo "User $name created\n";
	return $users;
}

function	edit_user($users, $name, $pass, $roles, $email, $home_address, $cb)
{
	foreach($users as $id=>$val)
	{
		if ($val["username"] === $name)
		{
			if ($val["role"] === "superadmin")
			{
				echo "Can't edit super admin, it's power level is too high\n";
				return $users;
			}
			if ($name)
				$user["username"] = $name;
			if ($pass)
				$user["pass"] = hash("whirlpool", $pass);
			if ($email)
				$user["email"] = $email;
			if ($roles)
				$user["role"] = $roles;
			if ($home_address)
				$user["address"] = $home_address;
			if ($cb)
				$user["cb"] = $cb;
			$users[$id]=$user;
			echo "User $name edited\n";
			return $users;
		}
	}
	echo "User $name not found\n";
	return $users;
}

function	delete_user($users, $name)
{
	foreach($users as $id=>$val)
	{
		if ($val["username"] === $name)
		{
			if ($val["role"] === "superadmin")
			{
				echo "Can't delete super admin, it's power level is too high\n";
				return $users;
			}
			unset($users[$id]);
			echo "User $name deleted\n";
			return $users;
		}
	}
	return $users;
}

?>
