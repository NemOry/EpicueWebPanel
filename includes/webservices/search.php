<?php 

require_once("../initialize.php");

$input 	 = $_POST['input'];

if(isset($_GET['itemtype']))
{
	if($_GET['itemtype'] == "user")
	{
		$users 	  	= User::search($input);
	}
	else if($_GET['itemtype'] == "store")
	{
		$stores  	= Store::search($input);
	}
	else if($_GET['itemtype'] == "product")
	{
		$products   = Product::search($input);
	}
	else if($_GET['itemtype'] == "traffic")
	{
		$traffics 	= Traffic::search($input);
	}
	else if($_GET['itemtype'] == "review")
	{
		$reviews 	= Review::search($input);
	}
}
else
{
	$users 	  	= User::search($input);
	$stores  	= Store::search($input);
	$products   = Product::search($input);
	$traffics 	= Traffic::search($input);
	$reviews 	= Review::search($input);
}

$tables = array();

if($users != null)
{
	$table = new Table("users", $users);
	array_push($tables, $table);
}

if($stores != null)
{
	$table = new Table("stores", $stores);
	array_push($tables, $table);
}

if($products != null)
{
	$table = new Table("products", $products);
	array_push($tables, $table);
}

if($traffics != null)
{
	$table = new Table("traffics", $traffics);
	array_push($tables, $table);
}

if($reviews != null)
{
	$table = new Table("reviews", $reviews);
	array_push($tables, $table);
}

if(count($tables) > 0)
{
	echo json_encode($tables);
}

class Table
{
	public $name;
	public $objects;

	function __construct($name, $objects)
	{
		$this->name 	= $name;
		$this->objects 	= $objects;
	}
}

?>