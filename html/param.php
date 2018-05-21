<?php
	session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  	<meta name="description" content="e-comerce">
  	<meta name="keywords" content="HTML,CSS,php">
  	<meta name="author" content="mpinson">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>magixisland.com</title>
</head>
<body>
	<div class="top_param">
		<a href="http://localhost:8080/index.php"><h1>magixisland.com</h1></a>

		<div class=contenu_param>
			
			
			reset votre mots de passe
			<form >
				Nouveau mot de passe: <input type="text" name="passwd" class="param-new-pass">
				ancien mot de passe: <input type="text" name="oldpasswd" class=param-mdp>
				<input type="button" name="submit" value="OK" class=param-btn-mdp>
			</form>

			<form method="post" action="../back/reset_email.php">
				nouveau mail: <input type="text" name="email" class="param-new-mail">
				<input type="button" name="submit" value="OK" class="param-btn-mail">
			</form>

			<form method="post" action="../back/reset_login.php">
				nouveau login: <input type="text" name="login" class="param-new-login">
				<input type="button" name="submit" value="OK" class="param-btn-login">
			</form>

			<form class="param-checkbox">
				
			</form>
			

			
		</div>
	</div>
</body>
<script type="text/javascript" src="../index.js"></script>
</html>
