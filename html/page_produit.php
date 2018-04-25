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

				<?php
					include "../phpfiles/init.php";
					include "../phpfiles/db_communication.php";
					$db = get_database();

					foreach ($db['products'] as $key => $val) {
						if($val['name'] == $_GET['id'])
						{
							$product = $val;
							break;
						}
					}
					
					echo "<img src='".$product['img_url']."' class='img_produit'>\n<p>".$product['description']."</p>";
				?>
				
				<div>
					<form method="post" action="../index.php?price=<?php echo $product['price'] ?>&id=<?php echo $product['name'] ?>">
					<?php echo $product['price'] ?> euro
						<input type="submit" name="submit" class=achat>
						
						<select name="select" id="monselect">
						  <option value="1" selected>1</option> 
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4">4</option>
						  <option value="5">5</option>
						  <option value="6">6</option>
						  <option value="7">7</option>
						  <option value="8">8</option>
						  <option value="9">9</option>
						  <option value="10">10</option>
						</select>
					</form>
				</div>
				<hr/>
			</div>



		</div>
		<div class="choix">
			<h1>categorie</h1>
			<hr>
		<!--  a remplir en php-->
			<?php
				$db = get_database();
				if($db['tags'])
				foreach ($db['tags'] as $key => $tag) {
					echo "<a href='../index.php?tag=".$key."'>".$tag['name']."</a><hr/>\n";
				}
			?>
		<!--  fin de remplissage-->		
		</div>
	</div>
</body>
</html>