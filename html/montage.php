<?php
?>

<!DOCTYPE html>
<html class="html">
<head>
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
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
		<a href="index.php"><h1>magixisland.com</h1></a>

		<div class="content">

			<div class="cadie">
				<a href="html/cart.php"><i class="fa fa-shopping-cart"></i></a>
			</div>
		<?php

			session_start();
			if(!empty($_SESSION['logged_on_user']))
			{
				echo "<div class=connection>\n<a href='html/login.php'>login</a>\n</div>\n<div class='creat'>\n<a href='html/creat.php'>creat acount</a>\n</div>\n";
			}
			else {
				echo "<div class='engine'>\n<a href='html/param.php'><i class='fa fa-cog'></i></i></a>\n</div>\n</i></a>\n<div class='creat'>\n<a href='html/logout.php'>logout</a>\n</div>\n";
			}
		?>
		</div>
	</div>
	<div class="content_montage">
		
			<div class=corpus2>
				<div class="img-photo">
					<video id="video"></video>
					<button id="startbutton">Prendre une photo</button>
					<canvas id="canvas"></canvas>
					
				</div>
			</div>


		<!--  a remplir en php

							<div class=article>
								<img src='" . $product['img_url'] . "'>
								<a href='html/page_produit.php?id=".$product['name']."' class=article_title>".$product['name']."</a>
								<br>
							</div>

		  fin de remplissage-->


		
		<div class="choix">
			<h1>categorie</h1>
			<hr>
		<!--  a remplir en php-->
			
		<!--  fin de remplissage-->
		</div>
	</div>
</body>
</html>