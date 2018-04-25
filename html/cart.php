<?php
	session_start();
	if($_GET['id'] || $_GET['id'] == "0")
	{
		unset($_SESSION['comande'][$_GET['id']]);
		sort($_SESSION['comande']);
	}
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
		<div class="corpus" style="text-align: center;">

		<!--  a remplir en php-->
		<?php
			session_start();
			include "../phpfiles/init.php";
			include "../phpfiles/db_communication.php";

			$db = get_database();
			$i = 0;
			if($_SESSION['comande'])
				foreach ($_SESSION['comande'] as $key => $val) {
					if($db['products'])
						foreach ($db['products'] as $k =>$product) {
								if($product['name'] == $val['id'])
								{
									$info = $product;
									break;
								}
							}
					if(!$info['name'])
						continue;


					$total += $info['price'] * $key['nb'];
					echo "<div class=article_achat>\n     <p><a href='cart.php?id=".$i."'><i class='far fa-times-circle' style='margin-right: 15px;''></i></a> <a href=''>".$info['name']."<a>   <p>".$info['price']." euro * ".$val['nb']."</p></p>\n<hr/>\n</div>\n";
					$i++;
				}
				if($_SESSION['comande'] && $total)
				{
					echo "<p>total = " . $total . " euro </p>\n<hr/>\n";
				}
		?>
		<?php
			session_start();
			include "../phpfiles/orders.php";
			//$_SESSION['comande'] = "";
			if($_SESSION['comande'] && $_SESSION['logged_on_user'])
			{?>
				<form method="post" action="../phpfiles/create_order.php">
					<?php $grail = serialize($_SESSION['comande']);?>
					<input type="hidden" name="order" value=<?php echo("'" . $grail . "'") ?>>
					<input type="hidden" name="user" value=<?php echo("'" . $_SESSION['logged_on_user'] . "'") ?>>
					<input type="submit" name="submit" value="Commander">
				</form>
			<?php
			// echo "<div class=valide>\nvalide la commande\n</div>\n";
			}
			?>

			</div>
		<!--  fin de remplissage-->

		</div>
		<div class="choix" style='top: 121px;'   >
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
