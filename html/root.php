<?php
	session_start();
	include_once "../phpfiles/init.php";
	include_once "../phpfiles/db_communication.php";
	$db = get_database();

	function is_root($db, $name) {

		foreach ($db['users'] as $key => $value) {
			if(($value['role'] == 'root' || $value['role'] == 'superadmin') && $value['username'] == $name)
				return true;
		}
		return false;
	}

	if(!$_SESSION['logged_on_user'] || !is_root($db, $_SESSION['logged_on_user']))
		return false;
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

		</div>
	</div>
	<div class="content">
		<div class="corpus" style="text-align: center;">

		<!--  a remplir en php-->
			<h1> supprimer utilisateur</h1>
			<?php

				if ($db['users'])
				{
					foreach ($db['users'] as $id=>$user)
					{
						?>
						<?php echo($user['username']) ?> <?php echo($user['role']) ?>
						<form method="post" action="../phpfiles/delete_user.php">
						<input type="hidden" name="name" value=<?php echo("'" . $user['username'] . "'") ?>>
						<input type="submit" name="submit" value="Delete">
						</form>
						<?php
					}
				}
			?>
			<!-- <p>supprimer utilisateur : <input type="" name="" placeholder="login"> <input type="submit" name=""></p> -->
			<hr/>
			<h1> ajoute utilisateur</h1>
				<form method="post" action="../phpfiles/create_user.php">
					login: <input type="text" name="login">
					mots de passe: <input type="text" name="passwd">
					mail: <input type="text" name="mail">
					<input type="submit" name="submit" value="OK">
				</form>
			<hr/>
			<h1> modifier utilisateur</h1>
				<form method="post" action="../phpfiles/edit_user.php">
					login: <input type="text" name="login">
					mots de passe: <input type="text" name="passwd">
					email : <input type="text" name="mail">
					<!-- role: <input type="text" name="role"> -->
					<select name="role">
						<option value="user">user</option>
						<option value="root">root</option>
						<option value="superadmin">superadmin</option>
					</select>
					<input type="submit" name="submit" value="OK">
				</form>
			<hr/>
			<h1>ajouter article</h1>
				<form method="post" action="../phpfiles/create_product.php">
					title: <input type="text" name="name">
					picture: <input type="text" name="img">
					description: <input type="text" name="description">
					categorie: <input type="text" name="tag">
					prix: <input type="text" name="price">
					<input type="submit" name="submit" value="OK">
				</form>
			<hr/>
			<h1>modifier article</h1>
				<form method="post" action="../phpfiles/edit_product.php">
					title: <input type="text" name="oldname">
					new_title: <input type="text" name="name">
					picture: <input type="text" name="img">
					description: <input type="text" name="description">
					categorie: <input type="text" name="tag">
					prix: <input type="text" name="price">
					<input type="submit" name="submit" value="OK">
				</form>
			<hr/>
			<h1>ajouter categorie a  article</h1>
				<form method="post" action="../phpfiles/add_tag_to_prod.php">
					title: <input type="text" name="prod_name">
					new_title: <input type="text" name="tag_name">
					<input type="submit" name="submit" value="add">
				</form>
			<hr/>
			<h1>supprimer article</h1>
			<!--  a remplir en php-->

			<?php
				include_once "../phpfiles/init.php";
				include_once "../phpfiles/db_communication.php";

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
				if ($db['products'])
				{
					foreach ($db['products'] as $product)
					{
						if(!$_GET['tag'] || ft_good_tag($db['tag'],$product))
						{
							?>
							<div class=article>
							<img src=<?php echo $product['img_url']?><a href='' class=article_title><?php echo $product['name'] ?></a>
							<br>
							<form method='post' action='../phpfiles/delete_product.php'>
							<br>
							<input type='hidden' name='name' value=<?php echo "'".$product['name']."'"?>>
							tags:
							<?php
							if ($product['tag_ids'])
							foreach($product['tag_ids'] as $val)
								echo "$val ";
							?>
							<input type='submit' name='submit' value='delete'>
							</form><br></div>
							<?php
						}
					}
				}

			?>
			<!--  fin de remplissage-->



		</div>
		<div class="choix">
			<h1>supprimer categorie</h1>
			<hr>
		<!--  a remplir en php-->

			<?php
				$db = get_database();

				if ($db['tags'])
				{
					foreach ($db['tags'] as $id=>$tag)
					{
						?>
						<a href="root.php?tag=<?php echo($tag['name']) ?>"> <?php echo($tag['name']) ?></a>
						<form method="post" action="../phpfiles/delete_tag.php">
						<input type="hidden" name="name" value=<?php echo("'" . $tag['name'] . "'") ?>>
						<input type="submit" name="submit" value="Delete">
						</form>
						<?php
					}
				}
			?>


		<!--  fin de remplissage-->
			<p>add categorie</p>
			<form method="post" action="../phpfiles/create_tag.php">
					title: <input type="text" name="name">
					<input type="submit" name="submit" value="OK">
				</form>
			<hr/>
			<p>modifier categorie</p>
			<form method="post" action="../phpfiles/edit_tag.php">
					title: <input type="text" name="oldname">
					<br>
					new_title: <input type="text" name="name">
					<br>
					<input type="submit" name="submit" value="OK">
				</form>
			<hr/>
		</div>
	</div>
</body>
</html>
