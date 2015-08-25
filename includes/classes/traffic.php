<?php 

require_once(INCLUDES_PATH.DS."config.php");
require_once(CLASSES_PATH.DS."database.php");

class Traffic extends DatabaseObject
{
	protected static $table_name = T_TRAFFICS;
	protected static $col_id = C_TRAFFIC_ID;

	public $id;
	public $userid;
	public $storeid;
	public $status;
	public $comment;
	public $longitude;
	public $latitude;
	public $picture;
	public $pending = 0;
	public $enabled = 1;
	public $datetime;

	public function create()
	{
		global $db;

		$sql = "INSERT INTO " 			. self::$table_name . " (";
		$sql .= C_TRAFFIC_USERID			.", ";
		$sql .= C_TRAFFIC_STOREID 		.", ";
		$sql .= C_TRAFFIC_STATUS 		.", ";
		$sql .= C_TRAFFIC_COMMENT 		.", ";
		$sql .= C_TRAFFIC_LONGITUDE 	.", ";
		$sql .= C_TRAFFIC_LATITUDE 		.", ";
		$sql .= C_TRAFFIC_PICTURE 		.", ";
		$sql .= C_TRAFFIC_PENDING 		.", ";
		$sql .= C_TRAFFIC_ENABLED 		.", ";
		$sql .= C_TRAFFIC_DATETIME;
		$sql .=") VALUES (";
		$sql .= " ".$db->escape_string($this->userid) 	.", ";
		$sql .= " ".$db->escape_string($this->storeid) 	.", ";
		$sql .= " ".$db->escape_string($this->status) 	.", ";
		$sql .= " '".$db->escape_string($this->comment) ."', ";
		$sql .= " '".$db->escape_string($this->longitude) ."', ";
		$sql .= " '".$db->escape_string($this->latitude) ."', ";
		$sql .= " '".$db->escape_string($this->picture) ."', ";
		$sql .= " ".$db->escape_string($this->pending) 	.", ";
		$sql .= " ".$db->escape_string($this->enabled) 	.", ";
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
		$sql .= C_TRAFFIC_USERID 		. "=" . $db->escape_string($this->userid) 			. ", ";
		$sql .= C_TRAFFIC_STOREID		. "=" . $db->escape_string($this->storeid) 			. ", ";
		$sql .= C_TRAFFIC_STATUS 		. "=" . $db->escape_string($this->status) 			. ", ";
		$sql .= C_TRAFFIC_COMMENT 		. "='" . $db->escape_string($this->comment) 		. "', ";
		$sql .= C_TRAFFIC_LONGITUDE 	. "='" . $db->escape_string($this->longitude) 		. "', ";
		$sql .= C_TRAFFIC_LATITUDE 		. "='" . $db->escape_string($this->latitude) 		. "', ";
		$sql .= C_TRAFFIC_PICTURE		. "='" . $db->escape_string($this->picture) 		. "', ";
		$sql .= C_TRAFFIC_PENDING 		. "=" . $db->escape_string($this->pending) 			. ", ";
		$sql .= C_TRAFFIC_ENABLED 		. "=" . $db->escape_string($this->enabled) 			. ", ";
		$sql .= C_TRAFFIC_DATETIME 		. "= NOW() ";
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

		$this_class->id 			= $record[C_TRAFFIC_ID];
		$this_class->userid 		= $record[C_TRAFFIC_USERID];
		$this_class->storeid 		= $record[C_TRAFFIC_STOREID];
		$this_class->status 		= $record[C_TRAFFIC_STATUS];
		$this_class->comment 		= $record[C_TRAFFIC_COMMENT];
		$this_class->longitude 		= $record[C_TRAFFIC_LONGITUDE];
		$this_class->latitude 		= $record[C_TRAFFIC_LATITUDE];
		$this_class->picture 		= base64_encode($record[C_TRAFFIC_PICTURE]);
		$this_class->pending 		= $record[C_TRAFFIC_PENDING];
		$this_class->enabled 		= $record[C_TRAFFIC_ENABLED];
		$this_class->datetime		= $record[C_TRAFFIC_DATETIME];

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
		$sql .= " WHERE ".C_TRAFFIC_COMMENT." LIKE '%".$input."%'";
		$sql .= " AND ".C_TRAFFIC_PENDING." = 0";
		$sql .= " AND ".C_TRAFFIC_ENABLED." = 1";
		$sql .= " LIMIT 20";

		$result = self::get_by_sql($sql);
		
		return !empty($result) ? $result : null;
	}
}

?>