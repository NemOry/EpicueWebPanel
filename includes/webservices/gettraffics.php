<?php

require_once("../initialize.php");

$where = " 1=1";

$limit = " LIMIT 1000 ";

$sortorder = " ASC ";
$sort = " ORDER BY ".C_TRAFFIC_ID." ";

//======================================================

if(!isset($_GET['30min']))
{
	$where .= " AND ".C_TRAFFIC_DATETIME." BETWEEN DATE_SUB(NOW(), INTERVAL 30 MINUTE) AND NOW()";
}

if(isset($_GET['userid']))
{
	$where .= " AND ".C_TRAFFIC_USERID.equallike($_GET['userid'], "int");
}

if(isset($_GET['storeid']))
{
	$where .= " AND ".C_TRAFFIC_STOREID.equallike($_GET['storeid'], "int");
}

if(isset($_GET['status']))
{
	$where .= " AND ".C_TRAFFIC_STATUS.equallike($_GET['status'], "int");
}

if(isset($_GET['longitude']))
{
	$where .= " AND ".C_TRAFFIC_LONGITUDE.equallike($_GET['longitude'], "string");
}

if(isset($_GET['latitude']))
{
	$where .= " AND ".C_TRAFFIC_LATITUDE.equallike($_GET['latitude'], "string");
}

if(isset($_GET['comment']))
{
	$where .= " AND ".C_TRAFFIC_COMMENT.equallike($_GET['comment'], "string");
}

if(isset($_GET['id']))
{
	$where .= " AND ".C_TRAFFIC_ID.equallike($_GET['id'], "int");
}

if(isset($_GET['pending']))
{
	$where .= " AND ".C_TRAFFIC_PENDING.equallike($_GET['pending'], "int");
}

if(isset($_GET['enabled']))
{
	$where .= " AND ".C_TRAFFIC_ENABLED.equallike($_GET['enabled'], "int");
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

$items = Traffic::get_by_sql("SELECT * FROM ".T_TRAFFICS." WHERE ".$where.$sort.$limit);

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