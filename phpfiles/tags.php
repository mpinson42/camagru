<?php
function	create_tag($tags, $name)
{
	if ($tags)
		foreach($tags as $val)
		{
			if ($val["name"] === $name)
			{
				echo "Category already exists\n";
				return $tags;
			}
		}
	$tag["name"]=$name;
	$tags[]=$tag;
	echo "Tag $name created\n";
	return $tags;
}

function	edit_tag($tags, $oldname, $name)
{
	foreach($tags as $key=>$tag)
	{
		if ($tag["name"] === $oldname)
		{
			$tag["name"] = $name;
			$tags[$key]=$tag;
			echo "Tag $oldname edited\n";
			return $tags;
		}
	}
	echo "Tag $oldname not found\n";
	return $tags;
}

function	delete_tag($tags, $name)
{
	foreach($tags as $key=>$tag)
	{
		if ($tag["name"] === $name)
		{
			unset($tags[$key]);
			echo "tag $name deleted\n";
			return $tags;
		}
	}
	return $tags;
}

?>
