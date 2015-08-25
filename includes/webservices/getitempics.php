<?php

require_once("../initialize.php");

$where = " 1=1";

$limit = " LIMIT 1000 ";

$sortorder = " ASC ";
$sort = " ORDER BY ".C_ITEMPIC_ID." ";

//======================================================

if(isset($_GET['itemid']))
{
	$where .= " AND ".C_ITEMPIC_ITEMID.equallike($_GET['itemid'], "int");
}

if(isset($_GET['itemtype']))
{
	$where .= " AND ".C_ITEMPIC_ITEMTYPE.equallike($_GET['itemtype'], "string");
}

if(isset($_GET['id']))
{
	$where .= " AND ".C_ITEMPIC_ID.equallike($_GET['id'], "int");
}

if(isset($_GET['pending']))
{
	$where .= " AND ".C_ITEMPIC_PENDING.equallike($_GET['pending'], "int");
}

if(isset($_GET['enabled']))
{
	$where .= " AND ".C_ITEMPIC_ENABLED.equallike($_GET['enabled'], "int");
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

$items = ItemPic::get_by_sql("SELECT * FROM ".T_ITEMPICS." WHERE ".$where.$sort.$limit);

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