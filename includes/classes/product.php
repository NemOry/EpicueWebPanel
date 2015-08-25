<?php 

require_once(INCLUDES_PATH.DS."config.php");
require_once(CLASSES_PATH.DS."database.php");

class Product extends DatabaseObject
{
	protected static $table_name = T_PRODUCTS;
	protected static $col_id = C_PRODUCT_ID;

	public $id;
	public $storeid;
	public $name;
	public $description;
	public $price;
	public $producttypeid;
	public $picture;
	public $pending = 0;
	public $enabled = 1;
	public $datetime;

	public function create()
	{
		global $db;

		$sql = "INSERT INTO " 			. self::$table_name . " (";
		$sql .= C_PRODUCT_STOREID			.", ";
		$sql .= C_PRODUCT_NAME			.", ";
		$sql .= C_PRODUCT_DESCRIPTION 	.", ";
		$sql .= C_PRODUCT_PRICE 		.", ";
		$sql .= C_PRODUCT_PRODUCTTYPEID .", ";
		$sql .= C_PRODUCT_PICTURE 		.", ";
		$sql .= C_PRODUCT_PENDING 		.", ";
		$sql .= C_PRODUCT_ENABLED 		.", ";
		$sql .= C_PRODUCT_DATETIME;
		$sql .=") VALUES (";
		$sql .= " ".$db->escape_string($this->storeid) 			.", ";
		$sql .= " '".$db->escape_string($this->name) 			."', ";
		$sql .= " '".$db->escape_string($this->description) 	."', ";
		$sql .= " ".$db->escape_string($this->price) 			.", ";
		$sql .= " ".$db->escape_string($this->producttypeid) 	.", ";
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

		$sql = "UPDATE " 				. self::$table_name . " SET ";
		$sql .= C_PRODUCT_STOREID 		. "=" . $db->escape_string($this->storeid) 			. ", ";
		$sql .= C_PRODUCT_NAME 			. "='" . $db->escape_string($this->name) 			. "', ";
		$sql .= C_PRODUCT_DESCRIPTION	. "='" . $db->escape_string($this->description) 	. "', ";
		$sql .= C_PRODUCT_PRICE 		. "=" . $db->escape_string($this->price) 			. ", ";
		$sql .= C_PRODUCT_PRODUCTTYPEID . "=" . $db->escape_string($this->producttypeid) 	. ", ";
		$sql .= C_PRODUCT_PICTURE		. "='" . $db->escape_string($this->picture) 		. "', ";
		$sql .= C_PRODUCT_PENDING 		. "=" . $db->escape_string($this->pending) 			. ", ";
		$sql .= C_PRODUCT_ENABLED 		. "=" . $db->escape_string($this->enabled) 			. ", ";
		$sql .= C_PRODUCT_DATETIME 		. "= NOW() ";
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

		$this_class->id 			= $record[C_PRODUCT_ID];
		$this_class->storeid 		= $record[C_PRODUCT_STOREID];
		$this_class->name 			= $record[C_PRODUCT_NAME];
		$this_class->description 	= $record[C_PRODUCT_DESCRIPTION];
		$this_class->price 			= $record[C_PRODUCT_PRICE];
		$this_class->producttypeid 	= $record[C_PRODUCT_PRODUCTTYPEID];
		$this_class->picture 		= base64_encode($record[C_PRODUCT_PICTURE]);
		$this_class->pending 		= $record[C_PRODUCT_PENDING];
		$this_class->enabled 		= $record[C_PRODUCT_ENABLED];
		$this_class->datetime		= $record[C_PRODUCT_DATETIME];

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
		$sql .= " WHERE ".C_PRODUCT_NAME." LIKE '%".$input."%'";
		$sql .= " OR ".C_PRODUCT_DESCRIPTION." LIKE '%".$input."%'";
		$sql .= " AND ".C_PRODUCT_PENDING." = 0";
		$sql .= " AND ".C_PRODUCT_ENABLED." = 1";
		$sql .= " LIMIT 20";

		$result = self::get_by_sql($sql);
		
		return !empty($result) ? $result : null;
	}

	public static function get_by_storeid($id)
	{
		global $db;
		$id = $db->escape_string($id);
		
		$sql = "SELECT * FROM " . self::$table_name;
		$sql .= " WHERE " 	. C_PRODUCT_STOREID . " = '" . $id . "'";
		
		$result_array = self::get_by_sql($sql);

		return !empty($result_array) ? $result_array : false;
	}
}

?>