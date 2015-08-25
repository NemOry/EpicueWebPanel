<?php 

require_once(INCLUDES_PATH.DS."config.php");
require_once(CLASSES_PATH.DS."database.php");

class FeaturedItem extends DatabaseObject
{
	protected static $table_name = T_FEATUREDITEMS;
	protected static $col_id = C_FEATUREDITEM_ID;

	public $id;
	public $itemid;
	public $itemtype;
	public $picture;
	public $priority 	= 0;
	public $override 	= 0;
	public $pending 	= 0;
	public $enabled 	= 1;
	public $datetime;

	public function create()
	{
		global $db;

		$sql = "INSERT INTO " 				. self::$table_name . " (";
		$sql .= C_FEATUREDITEM_ITEMID		.", ";
		$sql .= C_FEATUREDITEM_ITEMTYPE 	.", ";
		$sql .= C_FEATUREDITEM_PICTURE 		.", ";
		$sql .= C_FEATUREDITEM_PRIORITY 	.", ";
		$sql .= C_FEATUREDITEM_OVERRIDE 	.", ";
		$sql .= C_FEATUREDITEM_PENDING 		.", ";
		$sql .= C_FEATUREDITEM_ENABLED 		.", ";
		$sql .= C_FEATUREDITEM_DATETIME;
		$sql .=") VALUES (";
		$sql .= " ".$db->escape_string($this->itemid) 			.", ";
		$sql .= " '".$db->escape_string($this->itemtype) 		."', ";
		$sql .= " '".$db->escape_string($this->picture) 		."', ";
		$sql .= " ".$db->escape_string($this->priority) 		.", ";
		$sql .= " ".$db->escape_string($this->override) 		.", ";
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
		$sql .= C_FEATUREDITEM_ITEMID 		. "=" . $db->escape_string($this->itemid) 			. ", ";
		$sql .= C_FEATUREDITEM_ITEMTYPE		. "='" . $db->escape_string($this->itemtype) 		. "', ";
		$sql .= C_FEATUREDITEM_PICTURE		. "='" . $db->escape_string($this->picture) 		. "', ";
		$sql .= C_FEATUREDITEM_PRIORITY 	. "=" . $db->escape_string($this->priority) 		. ", ";
		$sql .= C_FEATUREDITEM_OVERRIDE 	. "=" . $db->escape_string($this->override) 			. ", ";
		$sql .= C_FEATUREDITEM_PENDING 		. "=" . $db->escape_string($this->pending) 			. ", ";
		$sql .= C_FEATUREDITEM_ENABLED 		. "=" . $db->escape_string($this->enabled) 			. ", ";
		$sql .= C_FEATUREDITEM_DATETIME 		. "= NOW() ";
		$sql .="WHERE " . self::$col_id . "=" . $db->escape_string($this->id) 	. "";

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

		$this_class->id 			= $record[C_FEATUREDITEM_ID];
		$this_class->itemid 		= $record[C_FEATUREDITEM_ITEMID];
		$this_class->itemtype 		= $record[C_FEATUREDITEM_ITEMTYPE];
		$this_class->picture 		= base64_encode($record[C_FEATUREDITEM_PICTURE]);
		$this_class->priority 		= $record[C_FEATUREDITEM_PRIORITY];
		$this_class->override 		= $record[C_FEATUREDITEM_OVERRIDE];
		$this_class->pending 		= $record[C_FEATUREDITEM_PENDING];
		$this_class->enabled 		= $record[C_FEATUREDITEM_ENABLED];
		$this_class->datetime		= $record[C_FEATUREDITEM_DATETIME];

		return $this_class;
	}

	public function picture()
	{
		return $this->picture;
	}

	public static function exists($itemid, $itemtype)
	{
		global $db;

		$itemid = $db->escape_string($itemid);
		$itemtype = $db->escape_string($itemtype);

		$sql = "SELECT * FROM " . self::$table_name;
		$sql .= " WHERE " . C_FEATUREDITEM_ITEMID . " = " . $itemid . "";
		$sql .= " AND " . C_FEATUREDITEM_ITEMTYPE . " = '" . $itemid . "'";

		$result = $db->query($sql);

		return ($db->get_num_rows($result) == 1) ? true : false;
	}
}

?>