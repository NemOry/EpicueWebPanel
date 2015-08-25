<?php

require_once("../initialize.php");

$where = " 1=1";

$limit = " LIMIT 1000 ";

$sortorder = " ASC ";
$sort = " ORDER BY ".C_PRODUCT_ID." ";

//======================================================

$userlongitude 	= "";
$userlatitude 	= "";
$distance 		= "5";

if(isset($_GET['userlongitude']))
{
	$userlongitude 	= $_GET['userlongitude'];
}

if(isset($_GET['userlatitude']))
{
	$userlatitude 	= $_GET['userlatitude'];
}

if(isset($_GET['distance']))
{
	$distance 	= $_GET['distance'];
}

if(isset($_GET['name']))
{
	$where .= " AND ".C_STORE_NAME.equallike($_GET['name'], "string");
}

if(isset($_GET['branchname']))
{
	$where .= " AND ".C_STORE_BRANCHNAME.equallike($_GET['branchname'], "string");
}

if(isset($_GET['address']))
{
	$where .= " AND ".C_STORE_ADDRESS.equallike($_GET['address'], "string");
}

if(isset($_GET['longitude']))
{
	$where .= " AND ".C_STORE_LONGITUDE.equallike($_GET['longitude'], "string");
}

if(isset($_GET['latitude']))
{
	$where .= " AND ".C_STORE_LATITUDE.equallike($_GET['latitude'], "string");
}

if(isset($_GET['address']))
{
	$where .= " AND ".C_STORE_ADDRESS.equallike($_GET['address'], "string");
}

if(isset($_GET['telnum']))
{
	$where .= " AND ".C_STORE_TELNUM.equallike($_GET['telnum'], "string");
}

if(isset($_GET['deliverynum']))
{
	$where .= " AND ".C_STORE_DELIVERYNUM.equallike($_GET['deliverynum'], "string");
}

if(isset($_GET['email']))
{
	$where .= " AND ".C_STORE_EMAIL.equallike($_GET['email'], "string");
}

if(isset($_GET['storetypeid']))
{
	$where .= " AND ".C_STORE_STORETYPEID.equallike($_GET['storetypeid'], "int");
}

if(isset($_GET['id']))
{
	$where .= " AND ".C_STORE_ID.equallike($_GET['id'], "int");
}

if(isset($_GET['pending']))
{
	$where .= " AND ".C_STORE_PENDING.equallike($_GET['pending'], "int");
}

if(isset($_GET['enabled']))
{
	$where .= " AND ".C_STORE_ENABLED.equallike($_GET['enabled'], "int");
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

$sql = " SELECT ";

$sql .= C_STORE_ID			.", ";
$sql .= C_STORE_NAME			.", ";
$sql .= C_STORE_BRANCHNAME 		.", ";
$sql .= C_STORE_ADDRESS 		.", ";
$sql .= C_STORE_LONGITUDE 		.", ";
$sql .= C_STORE_LATITUDE 		.", ";
$sql .= C_STORE_PICTURE 		.", ";
$sql .= C_STORE_TELNUM 			.", ";
$sql .= C_STORE_DELIVERYNUM 	.", ";
$sql .= C_STORE_EMAIL			.", ";
$sql .= C_STORE_STORETYPEID 	.", ";
$sql .= C_STORE_FACEBOOKID		.", ";
$sql .= C_STORE_TWITTERID 		.", ";
$sql .= C_STORE_PENDING 		.", ";
$sql .= C_STORE_ENABLED 		.", ";
$sql .= C_STORE_DATETIME 		.", ";

$sql .= "     ( 6371 * acos( cos( radians(".$userlatitude.") ) ";
$sql .= "                    * cos( radians( ".C_STORE_LATITUDE." ) ) ";
$sql .= "                    * cos( radians( ".C_STORE_LONGITUDE." ) ";
$sql .= "                        - radians(".$userlongitude.") ) ";
$sql .= "                    + sin( radians(".$userlatitude.") ) ";
$sql .= "                    * sin( radians( ".C_STORE_LATITUDE." ) ) ";
$sql .= "                  ) ";
$sql .= "    ) AS distance ";
$sql .= " FROM ".T_STORES." ";
$sql .= " HAVING distance < ".$distance." ";
$sql .= " AND WHERE ".$where." ";
$sql .= " ORDER BY distance ASC";

if(
		isset($_GET['userlongitude']) && 
		isset($_GET['userlatitude']) &&
		$_GET['userlongitude'] != "" && 
		$_GET['userlongitude'] != "0" && 
		$_GET['userlatitude'] != "" && 
		$_GET['userlatitude'] != "0" 
	)
{
	$items = Store::get_by_sql($sql);
}
else
{
	$items = Store::get_by_sql("SELECT * FROM ".T_STORES." WHERE ".$where.$sort.$limit);
}

$filename = 0;

foreach ($items as $item)
{
	$item->distance = (round($item->distance) > 0 ? round($item->distance) + "km" : round($item->distance / 0.0010000) + "m");

	$sql = "SELECT * FROM traffics WHERE storeid = ".$item->id;

	if(!isset($_GET['1hour']))
	{
		$sql .= " AND ".C_TRAFFIC_DATETIME." BETWEEN DATE_SUB(NOW(), INTERVAL 1 HOUR) AND NOW()";
	}


	$traffics = Traffic::get_by_sql($sql);

	$totaltraffics = 0;
	$lasttrafficdatetime = 0;

	if(count($traffics) > 0)
	{
		foreach ($traffics as $traffic)
		{
			$totaltraffics += $traffic->status;
		}
	}

	$item->averagestatus 		= true;
	$item->trafficcount 		= count($traffics);


	if($item->trafficcount > 0)
	{
		$item->trafficlevel 		= ($totaltraffics / $item->trafficcount);
	}

	if(count($traffics) > 0)
	{
		$item->lasttrafficdatetime 	= $traffics[count($traffics) - 1]->datetime;
	}

	//---------------------- REVIEWS

	$sql = "SELECT * FROM reviews WHERE itemid = ".$item->id." AND itemtype = store";

	$reviews = Review::get_by_sql($sql);

	$totalratings += $traffic->status;

	if(count($reviews) > 0)
	{
		foreach ($reviews as $review)
		{
			$totalratings += $review->rating;
		}

		$item->ratings 		= ($totalratings / count($reviews));
	}

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