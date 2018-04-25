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

		<form method="POST" action="../back/log.php">
			Identifiant: <input type="text" name="login">
			Mot de passe: <input type="password" name="passwd">
			<input type="submit" name="submit" value="OK">
		</form>

		<form method="POST" action="../back/reset_mdp.php">
			login pour reset mdp: <input type="password" name="login">
			<input type="submit" name="submit" value="OK">
		</form>

			
		</div>
	</div>
</body>
</html>