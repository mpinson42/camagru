<?php
	session_start();
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
			
			<div class="cadie">
				<a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
			</div>
		<?php
			session_start();
			if(!$_SESSION['logged_on_user'])
			{
				echo "<div class=connection>\n<a href='login.php'>login</a>\n</div>\n<div class='creat'>\n<a href='creat.php'>creat acount</a>\n</div>\n";
			}
			else {
				echo "<div class='engine'>\n<a href='param.php'><i class='fa fa-cog'></i></i></a>\n</div>\n</i></a>\n<div class='creat'>\n<a href='logout.php'>logout</a>\n</div>\n";
			}
		?>
		</div>
	</div>
	<div class="content">
		<div class="corpus">
			
			<div class=page_produit>
			<!--  a modifier-->
				
				<img src='../img/boblennon1.jpeg' class='img_produit'>

				<p>like :<input type="checkbox" id="coding" name="interest"></p>
			</div>

			<div class=comment>
					<h4>comment by : yunikki</h4>
					<p>oui</p>
					<hr>
					<form>
						<input type="text" name="">
						<input type="submit" name="">
					</form>
				</div>



		</div>
		<div class="choix">
			<h1>categorie</h1>
			<hr>
		<!--  a remplir en php-->
			
		<!--  fin de remplissage-->		
		</div>
	</div>
</body>
</html>