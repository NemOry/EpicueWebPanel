<?php 

require_once(INCLUDES_PATH.DS."config.php");
require_once(CLASSES_PATH.DS."database.php");

class User extends DatabaseObject
{
	protected static $table_name = T_USERS;
	protected static $col_id = C_USER_ID;

	public $id;
	public $username;
	public $password;
	public $email;
	public $firstname;
	public $middlename;
	public $lastname;
	public $birthdate;
	public $gender = 1;
	public $picture;
	public $twitterid = 0;
	public $facebookid = 0;
	public $foursquareid = 0;
	public $scoreloopid = 0;
	public $pending = 0;
	public $enabled = 1;
	public $datetime;

	public function create()
	{
		global $db;

		$sql = "INSERT INTO " . self::$table_name . " (";
		$sql .= C_USER_USERNAME		.", ";
		$sql .= C_USER_PASSWORD 	.", ";
		$sql .= C_USER_EMAIL 		.", ";
		$sql .= C_USER_FIRSTNAME 	.", ";
		$sql .= C_USER_MIDDLENAME 	.", ";
		$sql .= C_USER_LASTNAME 	.", ";
		$sql .= C_USER_BIRTHDATE	.", ";
		$sql .= C_USER_GENDER 		.", ";
		$sql .= C_USER_PICTURE 		.", ";
		$sql .= C_USER_TWITTERID 	.", ";
		$sql .= C_USER_FACEBOOKID 	.", ";
		$sql .= C_USER_FOURSQUAREID .", ";
		$sql .= C_USER_SCORELOOPID 	.", ";
		$sql .= C_USER_PENDING 		.", ";
		$sql .= C_USER_ENABLED 		.", ";
		$sql .= C_USER_DATETIME;
		$sql .=") VALUES (";
		$sql .= " '".$db->escape_string($this->username) 		."', ";
		$sql .= " '".hash('sha256', $db->escape_string($this->password)) ."', ";
		$sql .= " '".$db->escape_string($this->email) 			."', ";
		$sql .= " '".$db->escape_string($this->firstname) 		."', ";
		$sql .= " '".$db->escape_string($this->middlename) 		."', ";
		$sql .= " '".$db->escape_string($this->lastname) 		."', ";
		$sql .= " '".$db->escape_string($this->birthdate) 		."', ";
		$sql .= " ".$db->escape_string($this->gender) 			.", ";
		$sql .= " '".$db->escape_string($this->picture) 		."', ";
		$sql .= " ".$db->escape_string($this->twitterid) 		.", ";
		$sql .= " ".$db->escape_string($this->facebookid) 		.", ";
		$sql .= " ".$db->escape_string($this->foursquareid) 	.", ";
		$sql .= " ".$db->escape_string($this->scoreloopid) 		.", ";
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
		$sql .= C_USER_USERNAME 		. "='" . $db->escape_string($this->username) 		. "', ";
		$sql .= C_USER_PASSWORD			. "='" . hash('sha256', $db->escape_string($this->password)) 		. "', ";
		$sql .= C_USER_EMAIL 			. "='" . $db->escape_string($this->email) 			. "', ";
		$sql .= C_USER_FIRSTNAME		. "='" . $db->escape_string($this->firstname) 		. "', ";
		$sql .= C_USER_MIDDLENAME		. "='" . $db->escape_string($this->middlename) 		. "', ";
		$sql .= C_USER_LASTNAME			. "='" . $db->escape_string($this->lastname) 		. "', ";
		$sql .= C_USER_BIRTHDATE 		. "='" . $db->escape_string($this->birthdate) 		. "', ";
		$sql .= C_USER_GENDER 			. "=" . $db->escape_string($this->gender) 			. ", ";
		$sql .= C_USER_PICTURE 			. "='" . $db->escape_string($this->picture) 		. "', ";
		$sql .= C_USER_TWITTERID 		. "=" . $db->escape_string($this->twitterid) 		. ", ";
		$sql .= C_USER_FACEBOOKID 		. "=" . $db->escape_string($this->facebookid) 		. ", ";
		$sql .= C_USER_FOURSQUAREID 	. "=" . $db->escape_string($this->foursquareid) 	. ", ";
		$sql .= C_USER_SCORELOOPID 		. "=" . $db->escape_string($this->scoreloopid) 		. ", ";
		$sql .= C_USER_PENDING 			. "=" . $db->escape_string($this->pending) 			. ", ";
		$sql .= C_USER_ENABLED 			. "=" . $db->escape_string($this->enabled) 			. ", ";
		$sql .= C_USER_DATETIME 		. "= NOW() ";
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

		$this_class->id 			= $record[C_USER_ID];
		$this_class->username 		= $record[C_USER_USERNAME];
		$this_class->password 		= $record[C_USER_PASSWORD];
		$this_class->email 			= $record[C_USER_EMAIL];
		$this_class->firstname 		= $record[C_USER_FIRSTNAME];
		$this_class->middlename 	= $record[C_USER_MIDDLENAME];
		$this_class->lastname 		= $record[C_USER_LASTNAME];
		$this_class->birthdate 		= $record[C_USER_BIRTHDATE];
		$this_class->gender 		= $record[C_USER_GENDER];
		$this_class->picture 		= base64_encode($record[C_USER_PICTURE]);
		$this_class->twitterid 		= $record[C_USER_TWITTERID];
		$this_class->facebookid 	= $record[C_USER_FACEBOOKID];
		$this_class->foursquareid 	= $record[C_USER_FOURSQUAREID];
		$this_class->scoreloopid 	= $record[C_USER_SCORELOOPID];
		$this_class->pending 		= $record[C_USER_PENDING];
		$this_class->enabled 		= $record[C_USER_ENABLED];
		$this_class->datetime		= $record[C_USER_DATETIME];

		return $this_class;
	}

	public function is_super_admin()
	{
		global $db;
		$sql = "SELECT * FROM ".T_SUPERADMINS." WHERE ".C_SUPERADMIN_USERID." = ".$this->id;
		$result = $db->query($sql);
		return ($db->get_num_rows($result) == 1) ? true : false;
	}

	public function get_full_name()
	{
		if($this->firstname != "" || $this->middlename != "" || $this->lastname)
		{
			return $this->firstname." ".substr($this->middlename, 0, 1).". ".$this->lastname;
		}
		else
		{
			return "Guest";
		}
	}

	public function picture()
	{
		return $this->picture;
	}

	public static function username_exists($username)
	{
		global $db;

		$username = $db->escape_string($username);
		$sql = "SELECT * FROM " . self::$table_name . " WHERE " . C_USER_USERNAME . " = '" . $username . "'";
		$result = $db->query($sql);

		return ($db->get_num_rows($result) == 1) ? true : false;
	}

	public static function email_exists($email)
	{
		if($email != "")
		{
			global $db;

			$email = $db->escape_string($email);
			$sql = "SELECT * FROM " . self::$table_name . " WHERE " . C_USER_EMAIL . " = '" . $email . "'";
			$result = $db->query($sql);

			return ($db->get_num_rows($result) == 1) ? true : false;
		}
		else
		{
			return false;
		}
	}

	public static function login($username="", $password="")
	{
		global $db;
		$username 	= $db->escape_string($username);
		$password 	= hash('sha256', $db->escape_string($password));
		
		$sql = "SELECT * FROM " . self::$table_name;
		$sql .= " WHERE " 	. C_USER_USERNAME . " = '" . $username . "'";
		$sql .= " AND " 	. C_USER_PASSWORD . " = '" . $password . "'";
		$sql .= " LIMIT 1";
		
		$result = self::get_by_sql($sql);
		return !empty($result) ? array_shift($result) : null;
	}

	public static function loginEmail($email="", $password="")
	{
		global $db;
		$email 		= $db->escape_string($email);
		$password 	= hash('sha256', $db->escape_string($password));
		
		$sql = "SELECT * FROM " . self::$table_name;
		$sql .= " WHERE " 	. C_USER_EMAIL . " = '" . $email . "'";
		$sql .= " AND " 	. C_USER_PASSWORD . " = '" . $password . "'";
		$sql .= " LIMIT 1";
		
		$result = self::get_by_sql($sql);
		return !empty($result) ? array_shift($result) : null;
	}

	public static function get_by_twitterid($id)
	{
		global $db;
		$id = $db->escape_string($id);
		
		$sql = "SELECT * FROM " . self::$table_name;
		$sql .= " WHERE " 	. C_USER_TWITTERID . " = '" . $id . "'";
		$sql .= " LIMIT 1";
		
		$result_array = self::get_by_sql($sql);

		return !empty($result_array) ? array_shift($result_array) : false;
	}

	public static function get_by_facebookid($id)
	{
		global $db;
		$id = $db->escape_string($id);
		
		$sql = "SELECT * FROM " . self::$table_name;
		$sql .= " WHERE " 	. C_USER_FACEBOOKID . " = '" . $id . "'";
		$sql .= " LIMIT 1";
		
		$result_array = self::get_by_sql($sql);

		return !empty($result_array) ? array_shift($result_array) : false;
	}

	public static function get_by_foursquareid($id)
	{
		global $db;
		$id = $db->escape_string($id);
		
		$sql = "SELECT * FROM " . self::$table_name;
		$sql .= " WHERE " 	. C_USER_FOURSQUAREID . " = '" . $id . "'";
		$sql .= " LIMIT 1";
		
		$result_array = self::get_by_sql($sql);

		return !empty($result_array) ? array_shift($result_array) : false;
	}

	public static function get_by_scoreloopid($id)
	{
		global $db;
		$id = $db->escape_string($id);
		
		$sql = "SELECT * FROM " . self::$table_name;
		$sql .= " WHERE " 	. C_USER_SCORELOOPID . " = '" . $id . "'";
		$sql .= " LIMIT 1";
		
		$result_array = self::get_by_sql($sql);

		return !empty($result_array) ? array_shift($result_array) : false;
	}

	public static function search($input)
	{
		global $db;
		$input = $db->escape_string($input);

		$sql = "SELECT * FROM ".self::$table_name;
		$sql .= " WHERE ".C_USER_FIRSTNAME." LIKE '%".$input."%'";
		$sql .= " OR ".C_USER_MIDDLENAME." LIKE '%".$input."%'";
		$sql .= " OR ".C_USER_LASTNAME." LIKE '%".$input."%'";
		$sql .= " OR ".C_USER_USERNAME." LIKE '%".$input."%'";
		$sql .= " AND ".C_USER_PENDING." = 0";
		$sql .= " AND ".C_USER_ENABLED." = 1";
		$sql .= " LIMIT 20";

		$result = self::get_by_sql($sql);
		
		return !empty($result) ? $result : null;
	}
}

?>