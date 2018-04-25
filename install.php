<?php
if (!file_exists("./database"))
	mkdir("./database", 0777);
if(!file_exists("./database/db"))
{
	require 'phpfiles/users.php';
	require 'phpfiles/tags.php';
	require 'phpfiles/product.php';

	$db = array();
	$db["users"]=create_user($db["users"], "root", "root", "superadmin", "", "", "");
	$db["products"]=create_product($db["products"], "Dark Souls 3",70 ,"https://s.pacn.ws/640/s8/dark-souls-iii-the-fire-fades-edition-508127.1.jpg?ok9mdi" ,"A game for the true!");
	$db["products"]=create_product($db["products"], "Persona 5", 1070 ,"https://static.giantbomb.com/uploads/original/0/1992/2859232-91qtwpoklfl._sl1500_.jpg","Great game, would recommend it!");
	$db["products"]=create_product($db["products"], "Monster Hunter World", 80 ,"https://static-ca.ebgames.ca/images/products/732287/3max.jpg","Fucking Beetlejuice!");
	$db["tags"]=create_tag($db["tags"], "games");
	$db["tags"]=create_tag($db["tags"], "RPG");
	$db["tags"]=create_tag($db["tags"], "Jrpg");
	$db["tags"]=create_tag($db["tags"], "action");
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , "Dark Souls 3", "games");
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , "Dark Souls 3", "RPG");
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , "Dark Souls 3", "action");
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , "Monster Hunter World", "games");
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , "Persona 5", "RPG");
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , "Persona 5", "Jrpg");
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , "Persona 5", "games");

	$db["products"]=create_product($db["products"], "rambodash", 50, "https://orig00.deviantart.net/e7ea/f/2013/008/0/6/profile_picture_by_rembodash-d5qvh8g.png", "vivre les licorne sans corne !");
	$db["products"]=create_product($db["products"], "48 nain", 48, "https://vignette.wikia.nocookie.net/wikidupeuple/images/2/28/Nain_Art.png/revision/latest/scale-to-width-down/300?cb=20101010210223&path-prefix=fr", "48 nain pour creser un tunelle de 28 mettre dans du granite en 2 jour");
	$db["products"]=create_product($db["products"], "poulet en plastique", 3, "https://www.tendanceouest.com/photos/maxi/253355.jpg", "pour egailler vos soire !");
	$db["products"]=create_product($db["products"], "bob lennon !", 9999999, "https://vignette.wikia.nocookie.net/youtuberfrancais/images/e/e9/Portrait-Boblennon.jpg/revision/latest?cb=20150224164749&path-prefix=fr", "du feux du sang du bruit et du METALLLLLLL !");
	$db["products"]=create_product($db["products"], "mmontinet", 666666, "http://s1.dmcdn.net/CIj4Y/1280x720--Fd.jpg", "dance de la stack !");
	$db["products"]=create_product($db["products"], "cthulhu", 41542486, "https://ih0.redbubble.net/image.326731861.8877/mp,550x550,gloss,ffffff,t.3u1.jpg", "on peu pas prononcer sont nom bon courage !");
	$db["products"]=create_product($db["products"], "saint pelle", 666666, "https://www.forgesetjardins.com/I-Grande-17654-pelle-saint-etienne-carree-25-cm-col-de-cygne-a-manche-droit.net.jpg", "louer sois la saint pelle !");

	$db["tags"]=create_tag($db["tags"], "WTF");
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , "rambodash", "WTF");
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , "48 nain", "WTF");
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , "poulet en plastique", "WTF");
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , "bob lennon !", "WTF");
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , "mmontinet", "WTF");
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , "cthulhu", "WTF");
	$db["products"]=add_tag_to_product($db["products"], $db["tags"] , "saint pelle", "WTF");
	file_put_contents("./database/db", serialize($db));
}
?>
