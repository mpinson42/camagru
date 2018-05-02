<?php
	session_start();?>
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
	<div class="top_param">
		<a href="../index.php"><h1>magixisland.com</h1></a>

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
