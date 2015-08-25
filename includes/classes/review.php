<?php 

require_once(INCLUDES_PATH.DS."config.php");
require_once(CLASSES_PATH.DS."database.php");

class Review extends DatabaseObject
{
	protected static $table_name = T_REVIEWS;
	protected static $col_id = C_REVIEW_ID;

	public $id;
	public $userid;
	public $itemid;
	public $itemtype;
	public $review;
	public $rating;
	public $pending = 0;
	public $enabled = 1;
	public $datetime;

	public $picture;
	public $username;

	public function create()
	{
		global $db;

		$sql = "INSERT INTO " 			. self::$table_name . " (";
		$sql .= C_REVIEW_USERID			.", ";
		$sql .= C_REVIEW_ITEMID 		.", ";
		$sql .= C_REVIEW_ITEMTYPE 		.", ";
		$sql .= C_REVIEW_REVIEW 		.", ";
		$sql .= C_REVIEW_RATING 		.", ";
		$sql .= C_REVIEW_PENDING 		.", ";
		$sql .= C_REVIEW_ENABLED 		.", ";
		$sql .= C_REVIEW_DATETIME;
		$sql .=") VALUES (";
		$sql .= " ".$db->escape_string($this->userid) 	.", ";
		$sql .= " ".$db->escape_string($this->itemid) 	.", ";
		$sql .= " '".$db->escape_string($this->itemtype) ."', ";
		$sql .= " '".$db->escape_string($this->review) 	."', ";
		$sql .= " ".$db->escape_string($this->rating) 	.", ";
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
		$sql .= C_REVIEW_USERID 		. "=" . $db->escape_string($this->userid) 		. ", ";
		$sql .= C_REVIEW_ITEMID			. "=" . $db->escape_string($this->itemid) 		. ", ";
		$sql .= C_REVIEW_ITEMTYPE 		. "='" . $db->escape_string($this->itemtype) 	. "', ";
		$sql .= C_REVIEW_REVIEW 		. "='" . $db->escape_string($this->review) 		. "', ";
		$sql .= C_REVIEW_RATING			. "=" . $db->escape_string($this->rating) 		. ", ";
		$sql .= C_REVIEW_PENDING 		. "=" . $db->escape_string($this->pending) 		. ", ";
		$sql .= C_REVIEW_ENABLED 		. "=" . $db->escape_string($this->enabled) 		. ", ";
		$sql .= C_REVIEW_DATETIME 		. "= NOW() ";
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

		$this_class->id 			= $record[C_REVIEW_ID];
		$this_class->userid 		= $record[C_REVIEW_USERID];
		$this_class->itemid 		= $record[C_REVIEW_ITEMID];
		$this_class->itemtype 		= $record[C_REVIEW_ITEMTYPE];
		$this_class->review 		= $record[C_REVIEW_REVIEW];
		$this_class->rating 		= $record[C_REVIEW_RATING];
		$this_class->pending 		= $record[C_REVIEW_PENDING];
		$this_class->enabled 		= $record[C_REVIEW_ENABLED];
		$this_class->datetime		= $record[C_REVIEW_DATETIME];

		return $this_class;
	}

	public static function search($input)
	{
		global $db;
		$input = $db->escape_string($input);

		$sql = "SELECT * FROM ".self::$table_name;
		$sql .= " WHERE ".C_REVIEW_REVIEW." LIKE '%".$input."%'";
		$sql .= " AND ".C_REVIEW_PENDING." = 0";
		$sql .= " AND ".C_REVIEW_ENABLED." = 1";
		$sql .= " LIMIT 20";

		$result = self::get_by_sql($sql);
		
		return !empty($result) ? $result : null;
	}
}

?>