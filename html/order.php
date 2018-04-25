<?php
	session_start();
	include_once "../phpfiles/init.php";
	include_once "../phpfiles/db_communication.php";
	$db = get_database();

	function is_root($db, $name) {

		foreach ($db['users'] as $key => $value) {
			if(($value['role'] == 'root' || $value['role'] == 'superadmin') && $value['username'] == $name)
				return true;
		}
		return false;
	}

	if(!$_SESSION['logged_on_user'] || !is_root($db, $_SESSION['logged_on_user']))
		return false;
?>

<!DOCTYPE html>
<html>
<head>
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<meta charset="UTF-8">
  	<meta name="description" content="e-comerce">
  	<meta name="keywords" content="HTML,CSS,php">
  	<meta name="author" content="mpinson">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>magixisland.com</title>
</head>
<body>
	<div class="top">
		<a href="../index.php"><h1>magixisland.com</h1></a>

		<div class="content">

		</div>
	</div>
	<div class="content">
		<div class="corpus" style="text-align: center;">

		<!--  a remplir en php-->
		<?php
			$db = get_database();

			if($db['orders'] && $db['users'])
				foreach ($db['orders'] as $order => $value) {
					foreach ($db['users'] as $user) {
						if($value['client_id'] == $user['username'])
						{
							$this_user = $user['username'];
							break;
						}
					}








					foreach ($db['orders'][$order]['items'] as $com) {


						echo ("<p>l'utilisateur " . $this_user . " a commander " . $com['id'] . " " . $com['nb']. " fois</p>\n<br/>");
					}



					echo "<hr/>\n";
				}
		?>


		<!--  fin de remplissage-->



		</div>
		<div class="choix">
			<h1>supprimer categorie</h1>
			<hr>
		<!--  a remplir en php-->

			<?php
				$db = get_database();

				if ($db['tags'])
				{
					foreach ($db['tags'] as $id=>$tag)
					{
						echo "<a href='index.php?tag=".$id."'>".$tag['name']."</a>\n<hr/>\n";
					}
				}
			?>


		<!--  fin de remplissage-->

		</div>
	</div>
</body>
</html>
