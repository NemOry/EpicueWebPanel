<?php 

defined('DS') ? null : 				define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : 		define('SITE_ROOT'		, DS.'xampp'.DS.'htdocs'.DS.'epicue');
defined('DB_SERVER') ? null : 		define("DB_SERVER"		, "localhost");
defined('DB_NAME') ? null : 		define("DB_NAME"		, "wwwkelly_epicue");
defined('DB_USER') ? null : 		define("DB_USER"		, "root");
defined('DB_PASS') ? null : 		define("DB_PASS"		, "");
defined('HOSTNAME') ? null : 		define("HOSTNAME"		, "http://localhost/epicue/");
defined('HOST') ? null : 			define("HOST"			, "http://192.168.16.104/epicue/");

// defined('SITE_ROOT') ? null : 		define('SITE_ROOT'		, DS.'home'.DS.'wwwkelly'.DS.'public_html'.DS.'epicue');
// defined('DB_SERVER') ? null : 		define("DB_SERVER"		, "localhost");
// defined('DB_NAME') ? null : 			define("DB_NAME"		, "wwwkelly_epicue");
// defined('DB_USER') ? null : 			define("DB_USER"		, "wwwkelly_user");
// defined('DB_PASS') ? null : 			define("DB_PASS"		, "DhjkLmnOP2{}");
// defined('HOSTNAME') ? null : 		define("HOSTNAME"		, "http://epicue.kellyescape.com/");
// defined('HOST') ? null : 			define("HOST"			, "http://epicue.kellyescape.com/");

defined('INCLUDES_PATH') ? null : 	define('INCLUDES_PATH', SITE_ROOT.DS.'includes');
defined('PUBLIC_PATH') ? null : 	define('PUBLIC_PATH', SITE_ROOT.DS.'public');
defined('CLASSES_PATH') ? null : 	define('CLASSES_PATH', INCLUDES_PATH.DS.'classes');

defined('PHP_MAILER') ? null : 		define('PHP_MAILER', INCLUDES_PATH.DS.'PHPMailer');
defined('FACEBOOK_PHP_SDK') ? null :define('FACEBOOK_PHP_SDK', INCLUDES_PATH.DS.'facebook-php-sdk'.DS.'src');
defined('TWITTER_PHP_SDK') ? null :	define('TWITTER_PHP_SDK', INCLUDES_PATH.DS.'twitteroauth');
defined('RECAPTCHA_SDK') ? null :	define('RECAPTCHA_SDK', INCLUDES_PATH.DS.'recaptcha-php-1.11');

// HELPERS
require_once(INCLUDES_PATH.DS."config.php");
require_once(INCLUDES_PATH.DS."functions.php");

// CORE PHPS
require_once(CLASSES_PATH.DS."database.php");
require_once(CLASSES_PATH.DS."database_object.php");
require_once(CLASSES_PATH.DS."session.php");

// OBJECT PHPS
require_once(CLASSES_PATH.DS."user.php");
require_once(CLASSES_PATH.DS."superadmin.php");
require_once(CLASSES_PATH.DS."review.php");
require_once(CLASSES_PATH.DS."product.php");
require_once(CLASSES_PATH.DS."store.php");
require_once(CLASSES_PATH.DS."storetype.php");
require_once(CLASSES_PATH.DS."producttype.php");
require_once(CLASSES_PATH.DS."storepic.php");
require_once(CLASSES_PATH.DS."productpic.php");
require_once(CLASSES_PATH.DS."traffic.php");
require_once(CLASSES_PATH.DS."log.php");
require_once(CLASSES_PATH.DS."file.php");
require_once(CLASSES_PATH.DS."featureditem.php");
require_once(CLASSES_PATH.DS."itempic.php");

// PHP MAILER
require_once(PHP_MAILER.DS."class.phpmailer.php");
require_once(PHP_MAILER.DS."class.smtp.php");

// FACEBOOK PHP SDK
require_once(FACEBOOK_PHP_SDK.DS."facebook.php");

// TWITTER PHP SDK
require_once(TWITTER_PHP_SDK.DS."twitteroauth.php");

// RECAPTCHA
require_once(RECAPTCHA_SDK.DS."recaptchalib.php");

$clientip = $_SERVER['REMOTE_ADDR'];

?>