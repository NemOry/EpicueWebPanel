<?php 

require_once(INCLUDES_PATH.DS."config.php");
require_once(CLASSES_PATH.DS."database.php");

class ProductType extends DatabaseObject
{
	protected static $table_name = T_PRODUCTTYPES;
	protected static $col_id = C_PRODUCTTYPE_ID;

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
		$sql .= C_PRODUCTTYPE_NAME			.", ";
		$sql .= C_PRODUCTTYPE_DESCRIPTION 	.", ";
		$sql .= C_PRODUCTTYPE_PICTURE 		.", ";
		$sql .= C_PRODUCTTYPE_PENDING 		.", ";
		$sql .= C_PRODUCTTYPE_ENABLED 		.", ";
		$sql .= C_PRODUCTTYPE_DATETIME;
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
		$sql .= C_PRODUCTTYPE_NAME 			. "='" . $db->escape_string($this->name) 			. "', ";
		$sql .= C_PRODUCTTYPE_DESCRIPTION	. "='" . $db->escape_string($this->description) 	. "', ";
		$sql .= C_PRODUCTTYPE_PICTURE		. "='" . $db->escape_string($this->picture) 		. "', ";
		$sql .= C_PRODUCTTYPE_PENDING 		. "=" . $db->escape_string($this->pending) 			. ", ";
		$sql .= C_PRODUCTTYPE_ENABLED 		. "=" . $db->escape_string($this->enabled) 			. ", ";
		$sql .= C_PRODUCTTYPE_DATETIME 		. "= NOW() ";
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

		$this_class->id 			= $record[C_PRODUCTTYPE_ID];
		$this_class->name 			= $record[C_PRODUCTTYPE_NAME];
		$this_class->description 	= $record[C_PRODUCTTYPE_DESCRIPTION];
		$this_class->picture 		= base64_encode($record[C_PRODUCTTYPE_PICTURE]);
		$this_class->pending 		= $record[C_PRODUCTTYPE_PENDING];
		$this_class->enabled 		= $record[C_PRODUCTTYPE_ENABLED];
		$this_class->datetime		= $record[C_PRODUCTTYPE_DATETIME];

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
		$sql .= " WHERE ".C_PRODUCTTYPE_NAME." LIKE '%".$input."%'";
		$sql .= " OR ".C_PRODUCTTYPE_DESCRIPTION." LIKE '%".$input."%'";
		$sql .= " AND ".C_PRODUCTTYPE_PENDING." = 0";
		$sql .= " AND ".C_PRODUCTTYPE_ENABLED." = 1";
		$sql .= " LIMIT 20";

		$result = self::get_by_sql($sql);
		
		return !empty($result) ? $result : null;
	}
}

?>