<?php
	function auth($login, $passwd, $users)
	{
		foreach($users as $id=>$user)
		{
			
			if ($user["username"] === $login)
			{
				$tmp = hash("whirlpool", $passwd);
				if ($user["pass"] === $tmp)
					return TRUE;
				else
					return FALSE;
			}
		}
		return FALSE;
	}
?>
