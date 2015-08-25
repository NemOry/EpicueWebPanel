<?php

require_once("../initialize.php");

$where = " 1=1";

$limit = " LIMIT 1000 ";

$sortorder = " ASC ";
$sort = " ORDER BY ".C_PRODUCT_ID." ";

//======================================================

if(isset($_GET['username']))
{
	$where .= " AND ".C_USER_USERNAME.equallike($_GET['username'], "string");
}

if(isset($_GET['password']))
{
	$where .= " AND ".C_USER_PASSWORD.equallike($_GET['password'], "string");
}

if(isset($_GET['firstname']))
{
	$where .= " AND ".C_USER_FIRSTNAME.equallike($_GET['firstname'], "string");
}

if(isset($_GET['middlename']))
{
	$where .= " AND ".C_USER_MIDDLENAME.equallike($_GET['middlename'], "string");
}

if(isset($_GET['lastname']))
{
	$where .= " AND ".C_USER_LASTNAME.equallike($_GET['lastname'], "string");
}

if(isset($_GET['email']))
{
	$where .= " AND ".C_USER_EMAIL.equallike($_GET['email'], "string");
}

if(isset($_GET['birthdate']))
{
	$where .= " AND ".C_USER_BIRTHDATE.equallike($_GET['birthdate'], "string");
}

if(isset($_GET['gender']))
{
	$where .= " AND ".C_USER_GENDER.equallike($_GET['gender'], "int");
}

if(isset($_GET['twitterid']))
{
	$where .= " AND ".C_USER_TWITTERID.equallike($_GET['twitterid'], "int");
}

if(isset($_GET['facebookid']))
{
	$where .= " AND ".C_USER_FACEBOOKID.equallike($_GET['facebookid'], "int");
}

if(isset($_GET['foursquareid']))
{
	$where .= " AND ".C_USER_FOURSQUAREID.equallike($_GET['foursquareid'], "int");
}

if(isset($_GET['scoreloopid']))
{
	$where .= " AND ".C_USER_SCORELOOPID.equallike($_GET['scoreloopid'], "int");
}

if(isset($_GET['id']))
{
	$where .= " AND ".C_USER_ID.equallike($_GET['id'], "int");
}

if(isset($_GET['pending']))
{
	$where .= " AND ".C_USER_PENDING.equallike($_GET['pending'], "int");
}

if(isset($_GET['enabled']))
{
	$where .= " AND ".C_USER_ENABLED.equallike($_GET['enabled'], "int");
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

$items = User::get_by_sql("SELECT * FROM ".T_USERS." WHERE ".$where.$sort.$limit);

$filename = 0;


foreach ($items as $item)
{
	$item->password =
	
	if(!isset($_GET['blob']))
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