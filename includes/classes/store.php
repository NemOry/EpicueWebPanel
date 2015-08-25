<?php 

require_once(INCLUDES_PATH.DS."config.php");
require_once(CLASSES_PATH.DS."database.php");

class Store extends DatabaseObject
{
	protected static $table_name = T_STORES;
	protected static $col_id = C_STORE_ID;

	public $id;
	public $name;
	public $branchname;
	public $address;
	public $longitude;
	public $latitude;
	public $picture;
	public $telnum;
	public $deliverynum;
	public $email;
	public $storetypeid;
	public $facebookid = 0;
	public $twitterid = 0;
	public $pending = 0;
	public $enabled = 1;
	public $datetime;

	public $distance = 0;
	public $ratings = 0;
	public $trafficlevel = 0;
	public $trafficcount = 0;
	public $lasttrafficdatetime = "";

	public function create()
	{
		global $db;

		$sql = "INSERT INTO " 			. self::$table_name . " (";
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
		$sql .= C_STORE_DATETIME;
		$sql .=") VALUES (";
		$sql .= " '".$db->escape_string($this->name) 			."', ";
		$sql .= " '".$db->escape_string($this->branchname) 		."', ";
		$sql .= " '".$db->escape_string($this->address) 		."', ";
		$sql .= " '".$db->escape_string($this->longitude) 		."', ";
		$sql .= " '".$db->escape_string($this->latitude) 		."', ";
		$sql .= " '".$db->escape_string($this->picture) 		."', ";
		$sql .= " '".$db->escape_string($this->telnum) 			."', ";
		$sql .= " '".$db->escape_string($this->deliverynum) 	."', ";
		$sql .= " '".$db->escape_string($this->email) 			."', ";
		$sql .= " ".$db->escape_string($this->storetypeid) 		.", ";
		$sql .= " ".$db->escape_string($this->facebookid) 		.", ";
		$sql .= " ".$db->escape_string($this->twitterid) 		.", ";
		$sql .= " ".$db->escape_string($this->pending) 			.", ";
		$sql .= " ".$db->escape_string($this->enabled) 			.", ";
		$sql .= " NOW() ";
		$sql .=")";

		if($db->query($sql))
		{
			$this->id = $db->get_last_id();
			return true;
		}
		else
		{
			return false;	
		}
	}
	
	public function update()
	{
		global $db;

		$sql = "UPDATE " 				. self::$table_name . " SET ";
		$sql .= C_STORE_NAME 			. "='" . $db->escape_string($this->name) 		. "', ";
		$sql .= C_STORE_BRANCHNAME		. "='" . $db->escape_string($this->branchname) 	. "', ";
		$sql .= C_STORE_ADDRESS 		. "='" . $db->escape_string($this->address) 	. "', ";
		$sql .= C_STORE_LONGITUDE 		. "='" . $db->escape_string($this->longitude) 	. "', ";
		$sql .= C_STORE_LATITUDE 		. "='" . $db->escape_string($this->latitude) 	. "', ";
		$sql .= C_STORE_PICTURE 		. "='" . $db->escape_string($this->picture) 	. "', ";
		$sql .= C_STORE_TELNUM			. "='" . $db->escape_string($this->telnum) 		. "', ";
		$sql .= C_STORE_DELIVERYNUM		. "='" . $db->escape_string($this->deliverynum) . "', ";
		$sql .= C_STORE_EMAIL 			. "='" . $db->escape_string($this->email) 		. "', ";
		$sql .= C_STORE_STORETYPEID 	. "=" . $db->escape_string($this->storetypeid) 	. ", ";
		$sql .= C_STORE_FACEBOOKID 		. "=" . $db->escape_string($this->facebookid) 	. ", ";
		$sql .= C_STORE_TWITTERID 		. "=" . $db->escape_string($this->twitterid) 	. ", ";
		$sql .= C_STORE_PENDING 		. "=" . $db->escape_string($this->pending) 		. ", ";
		$sql .= C_STORE_ENABLED 		. "=" . $db->escape_string($this->enabled) 		. ", ";
		$sql .= C_STORE_DATETIME 		. "= NOW() ";
		$sql .="WHERE " . self::$col_id . "=" . $db->escape_string($this->id) 			. "";

		$db->query($sql);

		return ($db->get_affected_rows() == 1) ? true : false;
	}

	public function delete()
	{
		global $db;
		$sql = "DELETE FROM " . self::$table_name . " WHERE " . self::$col_id . "=" . $this->id . "";
		$db->query($sql);
		return ($db->get_affected_rows() == 1) ? true : false;
	}
	
	protected static function instantiate($record)
	{
		$this_class = new self;

		$this_class->id 			= $record[C_STORE_ID];
		$this_class->name 			= $record[C_STORE_NAME];
		$this_class->branchname 	= $record[C_STORE_BRANCHNAME];
		$this_class->address 		= $record[C_STORE_ADDRESS];
		$this_class->longitude 		= $record[C_STORE_LONGITUDE];
		$this_class->latitude 		= $record[C_STORE_LATITUDE];
		$this_class->picture 		= base64_encode($record[C_STORE_PICTURE]);
		$this_class->telnum 		= $record[C_STORE_TELNUM];
		$this_class->deliverynum 	= $record[C_STORE_DELIVERYNUM];
		$this_class->email 			= $record[C_STORE_EMAIL];
		$this_class->storetypeid 	= $record[C_STORE_STORETYPEID];
		$this_class->facebookid 	= $record[C_STORE_FACEBOOKID];	
		$this_class->twitterid 		= $record[C_STORE_TWITTERID];		
		$this_class->pending 		= $record[C_STORE_PENDING];
		$this_class->enabled 		= $record[C_STORE_ENABLED];
		$this_class->datetime		= $record[C_STORE_DATETIME];

		if(isset($record["distance"]))
		{
			$this_class->distance		= $record["distance"];
		}

		if(isset($record["ratings"]))
		{
			$this_class->ratings		= $record["ratings"];
		}

		if(isset($record["trafficlevel"]))
		{
			$this_class->trafficlevel		= $record["trafficlevel"];
		}

		if(isset($record["averagestatus"]))
		{
			$this_class->averagestatus		= $record["averagestatus"];
		}

		return $this_class;
	}

	public function picture()
	{
		return $this->picture;
	}

	public static function search($input)
	{
		global $db;
		$input = $db->escape_string($input);

		$sql = "SELECT * FROM ".self::$table_name;
		$sql .= " WHERE ".C_STORE_NAME." LIKE '%".$input."%'";
		$sql .= " OR ".C_STORE_BRANCHNAME." LIKE '%".$input."%'";
		$sql .= " AND ".C_STORE_PENDING." = 0";
		$sql .= " AND ".C_STORE_ENABLED." = 1";
		$sql .= " LIMIT 20";

		$result = self::get_by_sql($sql);
		
		return !empty($result) ? $result : null;
	}
}

?>