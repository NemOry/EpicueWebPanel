<?php 

require_once(INCLUDES_PATH.DS."config.php");
require_once(CLASSES_PATH.DS."database.php");

class StoreType extends DatabaseObject
{
	protected static $table_name = T_STORETYPES;
	protected static $col_id = C_STORETYPE_ID;

	public $id;
	public $name;
	public $description;
	public $picture;
	public $pending = 0;
	public $enabled = 1;
	public $datetime;

	public function create()
	{
		global $db;

		$sql = "INSERT INTO " 			. self::$table_name . " (";
		$sql .= C_STORETYPE_NAME			.", ";
		$sql .= C_STORETYPE_DESCRIPTION 	.", ";
		$sql .= C_STORETYPE_PICTURE 		.", ";
		$sql .= C_STORETYPE_PENDING 		.", ";
		$sql .= C_STORETYPE_ENABLED 		.", ";
		$sql .= C_STORETYPE_DATETIME;
		$sql .=") VALUES (";
		$sql .= " '".$db->escape_string($this->name) 			."', ";
		$sql .= " '".$db->escape_string($this->description) 	."', ";
		$sql .= " '".$db->escape_string($this->picture) 		."', ";
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

		$sql = "UPDATE " 					. self::$table_name . " SET ";
		$sql .= C_STORETYPE_NAME 			. "='" . $db->escape_string($this->name) 			. "', ";
		$sql .= C_STORETYPE_DESCRIPTION		. "='" . $db->escape_string($this->description) 	. "', ";
		$sql .= C_STORETYPE_PICTURE			. "='" . $db->escape_string($this->picture) 		. "', ";
		$sql .= C_STORETYPE_PENDING 		. "=" . $db->escape_string($this->pending) 			. ", ";
		$sql .= C_STORETYPE_ENABLED 		. "=" . $db->escape_string($this->enabled) 			. ", ";
		$sql .= C_STORETYPE_DATETIME 		. "= NOW() ";
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

		$this_class->id 			= $record[C_STORETYPE_ID];
		$this_class->name 			= $record[C_STORETYPE_NAME];
		$this_class->description 	= $record[C_STORETYPE_DESCRIPTION];
		$this_class->picture 		= base64_encode($record[C_STORETYPE_PICTURE]);
		$this_class->pending 		= $record[C_STORETYPE_PENDING];
		$this_class->enabled 		= $record[C_STORETYPE_ENABLED];
		$this_class->datetime		= $record[C_STORETYPE_DATETIME];

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
		$sql .= " WHERE ".C_STORETYPE_NAME." LIKE '%".$input."%'";
		$sql .= " OR ".C_STORETYPE_DESCRIPTION." LIKE '%".$input."%'";
		$sql .= " AND ".C_STORETYPE_PENDING." = 0";
		$sql .= " AND ".C_STORETYPE_ENABLED." = 1";
		$sql .= " LIMIT 20";

		$result = self::get_by_sql($sql);
		
		return !empty($result) ? $result : null;
	}
}

?>