<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  	<meta name="description" content="e-comerce">
  	<meta name="keywords" content="HTML,CSS,php">
  	<meta name="author" content="mpinson">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="../index.js"></script>
	<title>magixisland.com</title>
</head>
<body>
	<div class="top">
		<a href="http://localhost:8080/index.php"><h1>magixisland.com</h1></a>

		<form method="POST" action="../back/log.php">
			Identifiant: <input type="text" name="login" class="in_id_log">
			Mot de passe: <input type="password" name="passwd" class="in_mdp_log">
			<input type="button" name="submit" value="OK" class="btn_log">
		</form>

		<form method="POST" action="../back/reset_mdp.php">
			login pour reset mdp: <input class="in_reset_mdp" type="password" name="login">
			<input type="button" class="btn_reset_mdp" name="submit" value="OK">
		</form>

			
		</div>
	</div>
</body>
</html>