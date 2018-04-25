<?php
	session_start();

	include "init_index.php";
	$db = get_database();
	$i = 0;

	function is_root($db, $name) {

		foreach ($db['users'] as $key => $value) {
			if(($value['role'] != 'superadmin') && $value['username'] == $name)
				return true;
		}
		return false;
	}

	if($_GET['action'] == "del" && ft_is_root($db, $_SESSION['logged_on_user']))
	{
		foreach ($db['users'] as $key) {
			if($key['username'] == $_SESSION['logged_on_user'])
			{
				$_SESSION['logged_on_user'] = "";
				unset($db['users'][$i]);
				break;
			}
			$i++;
		}
		sort($db['users']);
		update_database($db);
	}
	if($_POST['select'])
	{
		$array['id'] = $_GET['id'];
		$array['nb'] = $_POST['select'];
		$_SESSION['comande'][] = $array;
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
	<link rel="stylesheet" type="text/css" href="html/style.css">
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
			if(!$_SESSION['logged_on_user'])
			{
				echo "<div class=connection>\n<a href='html/login.php'>login</a>\n</div>\n<div class='creat'>\n<a href='html/creat.php'>creat acount</a>\n</div>\n";
			}
			else {
				echo "<div class='engine'>\n<a href='html/param.php'><i class='fa fa-cog'></i></i></a>\n</div>\n</i></a>\n<div class='creat'>\n<a href='html/logout.php'>logout</a>\n</div>\n";
			}
		?>
		</div>
	</div>
	<div class="content">
		<div class="corpus">



		<!--  a remplir en php-->
			<?php
				function ft_good_tag($tags, $products) {
					if(!$products['tag_ids'])
						return false;
					foreach ($products['tag_ids'] as $key => $value) {
						if($value == $_GET['tag'])
						{
							return true;
						}
					}
					return false;
				}


				$db = get_database();
				if($db['products'])
					foreach ($db['products'] as $product) {
						if(!$_GET['tag'] || ft_good_tag($db['tags'],$product))
							echo "<div class=article>\n<img src='" . $product['img_url'] . "'>\n<a href='html/page_produit.php?id=".$product['name']."' class=article_title>".$product['name']."</a>\n<br>\n</div>\n";

					}
			?>
		<!--  fin de remplissage-->


		</div>
		<div class="choix">
			<h1>categorie</h1>
			<hr>
		<!--  a remplir en php-->
			<?php

				$db = get_database();
				if($db['tags'])
					foreach ($db['tags'] as $id => $tag) {
						echo "<a href='index.php?tag=".$tag['name']."'>".$tag['name']."</a>\n<hr/>\n";

					}
			?>
		<!--  fin de remplissage-->
		</div>
	</div>
</body>
</html>
