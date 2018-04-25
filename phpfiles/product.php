<?php
function	create_product($products, $name, $price, $img_url, $description)
{
	if ($products)
	{
		foreach($products as $val)
		{
			if ($val["name"] === $name)
			{
				echo "Product already exists\n";
				return $product;
			}
		}
	}
	$product["name"]=$name;
	$product["price"]=$price;
	$product["img_url"]=$img_url;
	$product["description"]=$description;
	$products[]=$product;
	echo "Product $name created\n";
	return $products;
}

function	edit_product($products, $oldname, $name, $price, $img_url, $description)
{
	foreach($products as $id=>$val)
	{
		if ($val["name"] === $oldname)
		{
			$product["name"]=$name;
			$product["price"]=$price;
			$product["img_url"]=$img_url;
			$product["description"]=$description;
			$products[$id]=$product;
			echo "Product $name edited";
			return $products;
		}
	}
	echo "Product does not exist\n";
	return $products;
}

function	check_if_tagged($tags, $tag_name)
{
	if ($tags)
		foreach($tags as $val)
		{
			if ($val["name"] === $tag_name)
			{
				return TRUE;
			}
		}
	return FALSE;
}

function	add_tag_to_product($products, $tags, $prod_name, $tag_name)
{
	foreach($products as $id=>$product)
	{
		if ($product["name"] === $prod_name)
		{
			if (check_if_tagged($tags, $tag_name) === TRUE)
			{
				if ($product["tag_ids"])
				{
					foreach($product["tag_ids"] as $v)
					{
						if ($v === $tag_name)
						{
							echo "Tag already added\n";
							return $products;
						}
					}
				}
				$product["tag_ids"][] = $tag_name;
				$products[$id]=$product;
				echo "Tag added to product\n";
				return $products;
			}
			echo "Tag does not exist\n";
			return $products;
		}
	}
	echo "Product does not exist\n";
	return $products;
}

function	delete_product($products, $name)
{
	foreach($products as $id=>$val)
	{
		if ($val["name"] === $name)
		{
			unset($products[$id]);
			echo"Product $name deleted\n";
			return $products;
		}
	}
	echo "Product $name not found\n";
	return $products;
}

?>
