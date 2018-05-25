<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  	<meta name="description" content="e-comerce">
  	<meta name="keywords" content="HTML,CSS,php">
  	<meta name="author" content="mpinson">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="../index.js"></script>
	<meta name="google-signin-client_id" content="716136405353-3lcoqcmqt36c2mjui4f0uannob9oosos.apps.googleusercontent.com">
  	<script src="https://apis.google.com/js/client:platform.js?onload=GoogleRenderButton" async defer></script>
	<title>Camagru.com</title>
</head>
<body>
	<div class="top">
		<a href="http://localhost:8080/index.php"><h1>Camagru.com</h1></a>

		<form method="POST" action="../back/log.php">
			Identifiant: <input type="text" name="login" class="in_id_log">
			Mot de passe: <input type="password" name="passwd" class="in_mdp_log">
			<input type="button" name="submit" value="OK" class="btn_log">
		</form>

		<form method="POST" action="../back/reset_mdp.php">
			login pour reset mdp: <input class="in_reset_mdp" type="password" name="login">
			<input type="button" class="btn_reset_mdp" name="submit" value="OK">
		</form>
		<div style="position: relative;">
			<div id="gSignIn" style="margin-left: 20%;"></div>
			<a href="http://localhost:8080/back/facebook.php">
				<img src="http://localhost:8080/img/facebook.png" style="width: 50px; height: 50px; position: absolute; top: 0; right: 20%">
			</a>
		</div>
		</div>
	</div>
</body>
</html>