<?php 

require_once(INCLUDES_PATH.DS."config.php");
require_once(CLASSES_PATH.DS."database.php");

class ProductPic extends DatabaseObject
{
	protected static $table_name = T_PRODUCTPICS;
	protected static $col_id = C_PRODUCTPIC_ID;

	public $id;
	public $productid;
	public $picture;
	public $pending = 0;
	public $enabled = 1;
	public $datetime;

	public function create()
	{
		global $db;

		$sql = "INSERT INTO " 				. self::$table_name . " (";
		$sql .= C_PRODUCTPIC_PRODUCTID		.", ";
		$sql .= C_PRODUCTPIC_PICTURE 		.", ";
		$sql .= C_PRODUCTPIC_PENDING 		.", ";
		$sql .= C_PRODUCTPIC_ENABLED 		.", ";
		$sql .= C_PRODUCTPIC_DATETIME;
		$sql .=") VALUES (";
		$sql .= " ".$db->escape_string($this->productid) 		.", ";
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
		$sql .= C_PRODUCTPIC_PRODUCTID 		. "=" . $db->escape_string($this->productid) 		. ", ";
		$sql .= C_PRODUCTPIC_PICTURE		. "='" . $db->escape_string($this->picture) 		. "', ";
		$sql .= C_PRODUCTPIC_PENDING 		. "=" . $db->escape_string($this->pending) 			. ", ";
		$sql .= C_PRODUCTPIC_ENABLED 		. "=" . $db->escape_string($this->enabled) 			. ", ";
		$sql .= C_PRODUCTPIC_DATETIME 		. "= NOW() ";
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

		$this_class->id 			= $record[C_PRODUCTPIC_ID];
		$this_class->productid 		= $record[C_PRODUCTPIC_PRODUCTID];
		$this_class->picture 		= base64_encode($record[C_PRODUCTPIC_PICTURE]);
		$this_class->pending 		= $record[C_PRODUCTPIC_PENDING];
		$this_class->enabled 		= $record[C_PRODUCTPIC_ENABLED];
		$this_class->datetime		= $record[C_PRODUCTPIC_DATETIME];

		return $this_class;
	}

	public function picture()
	{
		return $this->picture;
	}
}

?>