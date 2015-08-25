<?php 

require_once(INCLUDES_PATH.DS."config.php");
require_once(CLASSES_PATH.DS."database.php");

class StorePic extends DatabaseObject
{
	protected static $table_name = T_STOREPICS;
	protected static $col_id = C_STOREPIC_ID;

	public $id;
	public $storeid;
	public $picture;
	public $pending = 0;
	public $enabled = 1;
	public $datetime;

	public function create()
	{
		global $db;

		$sql = "INSERT INTO " 			. self::$table_name . " (";
		$sql .= C_STOREPIC_STOREID		.", ";
		$sql .= C_STOREPIC_PICTURE 		.", ";
		$sql .= C_STOREPIC_PENDING 		.", ";
		$sql .= C_STOREPIC_ENABLED 		.", ";
		$sql .= C_STOREPIC_DATETIME;
		$sql .=") VALUES (";
		$sql .= " ".$db->escape_string($this->storeid) 			.", ";
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
		$sql .= C_STOREPIC_STOREID 		. "=" . $db->escape_string($this->storeid) 			. ", ";
		$sql .= C_STOREPIC_PICTURE		. "='" . $db->escape_string($this->picture) 		. "', ";
		$sql .= C_STOREPIC_PENDING 		. "=" . $db->escape_string($this->pending) 			. ", ";
		$sql .= C_STOREPIC_ENABLED 		. "=" . $db->escape_string($this->enabled) 			. ", ";
		$sql .= C_STOREPIC_DATETIME 		. "= NOW() ";
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

		$this_class->id 			= $record[C_STOREPIC_ID];
		$this_class->storeid 		= $record[C_STOREPIC_STOREID];
		$this_class->picture 		= base64_encode($record[C_STOREPIC_PICTURE]);
		$this_class->pending 		= $record[C_STOREPIC_PENDING];
		$this_class->enabled 		= $record[C_STOREPIC_ENABLED];
		$this_class->datetime		= $record[C_STOREPIC_DATETIME];

		return $this_class;
	}

	public function picture()
	{
		return $this->picture;
	}
}

?>