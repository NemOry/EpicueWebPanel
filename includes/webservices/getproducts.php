<?php

require_once("../initialize.php");

$where = " 1=1";

$limit = " LIMIT 1000 ";

$sortorder = " ASC ";
$sort = " ORDER BY ".C_PRODUCT_ID." ";

//======================================================

if(isset($_GET['storeid']))
{
	$where .= " AND ".C_PRODUCT_ID.equallike($_GET['storeid'], "int");
}

if(isset($_GET['name']))
{
	$where .= " AND ".C_PRODUCT_NAME.equallike($_GET['name'], "string");
}

if(isset($_GET['description']))
{
	$where .= " AND ".C_PRODUCT_DESCRIPTION.equallike($_GET['description'], "string");
}

if(isset($_GET['price']))
{
	$where .= " AND ".C_PRODUCT_PRICE.equallike($_GET['price'], "int");
}

if(isset($_GET['producttypeid']))
{
	$where .= " AND ".C_PRODUCT_PRODUCTTYPEID.equallike($_GET['producttypeid'], "int");
}

if(isset($_GET['id']))
{
	$where .= " AND ".C_PRODUCT_ID.equallike($_GET['id'], "int");
}

if(isset($_GET['pending']))
{
	$where .= " AND ".C_PRODUCT_PENDING.equallike($_GET['pending'], "int");
}

if(isset($_GET['enabled']))
{
	$where .= " AND ".C_PRODUCT_ENABLED.equallike($_GET['enabled'], "int");
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

$items = Product::get_by_sql("SELECT * FROM ".T_PRODUCTS." WHERE ".$where.$sort.$limit);

$filename = 0;

if(!isset($_GET['blob']))
{
	foreach ($items as $item)
	{
		$filename++;

		$random = rand(0, 1);

		file_put_contents("images/".$filename."x".$random.".jpg", base64_decode($item->picture));

		$item->picture = HOST."includes/webservices/images/".$filename."x".$random.".jpg";
	}
}

echo str_replace('\/','/',json_encode($items));

//echo json_encode($items, JSON_UNESCAPED_SLASHES);

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