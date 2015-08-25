<?php

require_once("../initialize.php");

$where = " 1=1";

$limit = " LIMIT 1000 ";

$sortorder = " ASC ";
$sort = " ORDER BY ".C_FEATUREDITEM_ID." ";

//======================================================

if(isset($_GET['itemid']))
{
	$where .= " AND ".C_FEATUREDITEM_ITEMID.equallike($_GET['itemid'], "int");
}

if(isset($_GET['itemtype']))
{
	$where .= " AND ".C_FEATUREDITEM_ITEMTYPE.equallike($_GET['itemtype'], "string");
}

if(isset($_GET['priority']))
{
	$where .= " AND ".C_FEATUREDITEM_PRIORITY.equallike($_GET['priority'], "int");
}

if(isset($_GET['id']))
{
	$where .= " AND ".C_FEATUREDITEM_ID.equallike($_GET['id'], "int");
}

if(isset($_GET['pending']))
{
	$where .= " AND ".C_FEATUREDITEM_PENDING.equallike($_GET['pending'], "int");
}

if(isset($_GET['enabled']))
{
	$where .= " AND ".C_FEATUREDITEM_ENABLED.equallike($_GET['enabled'], "int");
}

//======================================================

if(isset($_GET['limit']))
{
	$limit = " LIMIT ".$_GET['limit']." ";
}

if(isset($_GET['sortby']) && isset($_GET['sortorder']))
{
	$sort = " ORDER BY ".$_GET['sortby']." ".$_GET['sortorder']." ";
}

if(isset($_GET['sortby']) && !isset($_GET['sortorder']))
{
	$sort = " ORDER BY ".$_GET['sortby'].$sortorder." ";
}

//======================================================

$sql = "SELECT * FROM ".T_FEATUREDITEMS." WHERE ".$where.$sort.$limit;

//echo $sql."<br />";

$items = FeaturedItem::get_by_sql($sql);

$filename = 0;

$stores = array();

if(!isset($_GET['blob']))
{
	foreach ($items as $item)
	{
		$store = Store::get_by_id($item->itemid);

		if($item->override == 1)
		{
			$store->picture = $item->picture;
		}

		$filename++;

		$random = rand(0, 1);

		file_put_contents("images/".$filename."xx".$random.".jpg", base64_decode($store->picture));

		$store->picture = HOST."includes/webservices/images/".$filename."x".$random.".jpg";

		array_push($stores, $store);

		// if($item->override == 1)
		// {
		// 	if($item->itemtype == "store")
		// 	{
		// 		$item->picture = Store::get_by_id($item->itemid)->picture;
		// 	}
		// 	else if($item->itemtype == "product")
		// 	{
		// 		$item->picture = Product::get_by_id($item->itemid)->picture;
		// 	}
		// }

		// file_put_contents("images/".$filename."x".$random.".jpg", base64_decode($item->picture));

		// $item->picture = HOST."includes/webservices/images/".$filename."x".$random.".jpg";
	}
}

echo str_replace('\/','/',json_encode($stores));

// echo str_replace('\/','/',json_encode($items));

function equallike($field, $type)
{
	$string = "";

	if($type == "string")
	{
		if(isset($_GET['equal']))
		{
			$string = " = '".$field."'";
		}
		else
		{
			$string = " LIKE '%".$field."%'";
		}
	}
	else if($type == "int")
	{
		$string = " = ".$field."";
	}

	return $string;
}

?>