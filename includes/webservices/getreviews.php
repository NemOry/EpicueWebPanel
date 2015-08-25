<?php

require_once("../initialize.php");

$where = " 1=1";

$limit = " LIMIT 1000 ";

$sortorder = " ASC ";
$sort = " ORDER BY ".C_REVIEW_ID." ";

//======================================================

if(isset($_GET['userid']))
{
	$where .= " AND ".C_REVIEW_USERID.equallike($_GET['userid'], "int");
}

if(isset($_GET['itemid']))
{
	$where .= " AND ".C_REVIEW_ITEMID.equallike($_GET['itemid'], "int");
}

if(isset($_GET['itemtype']))
{
	$where .= " AND ".C_REVIEW_ITEMTYPE.equallike($_GET['itemtype'], "string");
}

if(isset($_GET['review']))
{
	$where .= " AND ".C_REVIEW_REVIEW.equallike($_GET['review'], "string");
}

if(isset($_GET['rating']))
{
	$where .= " AND ".C_REVIEW_RATING.equallike($_GET['rating'], "int");
}


if(isset($_GET['id']))
{
	$where .= " AND ".C_REVIEW_ID.equallike($_GET['id'], "int");
}

if(isset($_GET['pending']))
{
	$where .= " AND ".C_REVIEW_PENDING.equallike($_GET['pending'], "int");
}

if(isset($_GET['enabled']))
{
	$where .= " AND ".C_REVIEW_ENABLED.equallike($_GET['enabled'], "int");
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

$items = Review::get_by_sql("SELECT * FROM ".T_REVIEWS." WHERE ".$where.$sort.$limit);

$filename = 0;

if(!isset($_GET['blob']))
{
	foreach ($items as $item)
	{
		$filename++;

		$random = rand(0, 1);

		$user = User::get_by_id($item->userid);

		$item->username = $user->get_full_name();

		file_put_contents("images/".$filename."x".$random.".jpg", base64_decode($user->picture));

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