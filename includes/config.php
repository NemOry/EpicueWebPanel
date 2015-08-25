<?php 

// ----------------------------------------- USERS TABLE  ------------------------------------------------------- \\
defined('T_USERS') ? null :						define("T_USERS"					, "users");
defined('C_USER_ID') ? null : 					define("C_USER_ID"					, "id");
defined('C_USER_USERNAME') ? null : 			define("C_USER_USERNAME"			, "username");
defined('C_USER_PASSWORD') ? null : 			define("C_USER_PASSWORD"			, "password");
defined('C_USER_EMAIL') ? null : 				define("C_USER_EMAIL"				, "email");
defined('C_USER_FIRSTNAME') ? null : 			define("C_USER_FIRSTNAME"			, "firstname");
defined('C_USER_MIDDLENAME') ? null : 			define("C_USER_MIDDLENAME"			, "middlename");
defined('C_USER_LASTNAME') ? null : 			define("C_USER_LASTNAME"			, "lastname");
defined('C_USER_BIRTHDATE') ? null : 			define("C_USER_BIRTHDATE"			, "birthdate");
defined('C_USER_GENDER') ? null : 				define("C_USER_GENDER"				, "gender");
defined('C_USER_PICTURE') ? null : 				define("C_USER_PICTURE"				, "picture");
defined('C_USER_TWITTERID') ? null : 			define("C_USER_TWITTERID"			, "twitterid");
defined('C_USER_FACEBOOKID') ? null :			define("C_USER_FACEBOOKID"			, "facebookid");
defined('C_USER_FOURSQUAREID') ? null : 		define("C_USER_FOURSQUAREID"		, "foursquareid");
defined('C_USER_SCORELOOPID') ? null :			define("C_USER_SCORELOOPID"			, "scoreloopid");
defined('C_USER_PENDING') ? null : 				define("C_USER_PENDING"				, "pending");
defined('C_USER_ENABLED') ? null : 				define("C_USER_ENABLED"				, "enabled");
defined('C_USER_DATETIME') ? null :				define("C_USER_DATETIME"			, "datetime");

// ----------------------------------------- PRODUCTS TABLE  ------------------------------------------------------- \\
defined('T_PRODUCTS') ? null :					define("T_PRODUCTS"					, "products");
defined('C_PRODUCT_ID') ? null : 				define("C_PRODUCT_ID"				, "id");
defined('C_PRODUCT_STOREID') ? null : 			define("C_PRODUCT_STOREID"			, "storeid");
defined('C_PRODUCT_NAME') ? null : 				define("C_PRODUCT_NAME"				, "name");
defined('C_PRODUCT_DESCRIPTION') ? null : 		define("C_PRODUCT_DESCRIPTION"		, "description");
defined('C_PRODUCT_PRICE') ? null : 			define("C_PRODUCT_PRICE"			, "price");
defined('C_PRODUCT_PRODUCTTYPEID') ? null : 	define("C_PRODUCT_PRODUCTTYPEID"	, "producttypeid");
defined('C_PRODUCT_PICTURE') ? null : 			define("C_PRODUCT_PICTURE"			, "picture");
defined('C_PRODUCT_PENDING') ? null : 			define("C_PRODUCT_PENDING"			, "pending");
defined('C_PRODUCT_ENABLED') ? null : 			define("C_PRODUCT_ENABLED"			, "enabled");
defined('C_PRODUCT_DATETIME') ? null :			define("C_PRODUCT_DATETIME"			, "datetime");

// ----------------------------------------- STORES TABLE  ------------------------------------------------------- \\
defined('T_STORES') ? null :					define("T_STORES"					, "stores");
defined('C_STORE_ID') ? null : 					define("C_STORE_ID"					, "id");
defined('C_STORE_NAME') ? null : 				define("C_STORE_NAME"				, "name");
defined('C_STORE_BRANCHNAME') ? null : 			define("C_STORE_BRANCHNAME"			, "branchname");
defined('C_STORE_DESCRIPTION') ? null : 		define("C_STORE_DESCRIPTION"		, "description");
defined('C_STORE_ADDRESS') ? null : 			define("C_STORE_ADDRESS"			, "address");
defined('C_STORE_LONGITUDE') ? null : 			define("C_STORE_LONGITUDE"			, "longitude");
defined('C_STORE_LATITUDE') ? null : 			define("C_STORE_LATITUDE"			, "latitude");
defined('C_STORE_PICTURE') ? null : 			define("C_STORE_PICTURE"			, "picture");
defined('C_STORE_TELNUM') ? null : 				define("C_STORE_TELNUM"				, "telnum");
defined('C_STORE_DELIVERYNUM') ? null : 		define("C_STORE_DELIVERYNUM"		, "deliverynum");
defined('C_STORE_EMAIL') ? null : 				define("C_STORE_EMAIL"				, "email");
defined('C_STORE_STORETYPEID') ? null : 		define("C_STORE_STORETYPEID"		, "storetypeid");
defined('C_STORE_FACEBOOKID') ? null : 			define("C_STORE_FACEBOOKID"			, "facebookid");
defined('C_STORE_TWITTERID') ? null : 			define("C_STORE_TWITTERID"			, "twitterid");
defined('C_STORE_PENDING') ? null : 			define("C_STORE_PENDING"			, "pending");
defined('C_STORE_ENABLED') ? null : 			define("C_STORE_ENABLED"			, "enabled");
defined('C_STORE_DATETIME') ? null :			define("C_STORE_DATETIME"			, "datetime");

// ----------------------------------------- STORE TYPES TABLE  ------------------------------------------------------- \\
defined('T_STORETYPES') ? null :				define("T_STORETYPES"				, "storetypes");
defined('C_STORETYPE_ID') ? null : 				define("C_STORETYPE_ID"				, "id");
defined('C_STORETYPE_NAME') ? null : 			define("C_STORETYPE_NAME"			, "name");
defined('C_STORETYPE_DESCRIPTION') ? null : 	define("C_STORETYPE_DESCRIPTION"	, "description");
defined('C_STORETYPE_PICTURE') ? null : 		define("C_STORETYPE_PICTURE"		, "picture");
defined('C_STORETYPE_PENDING') ? null : 		define("C_STORETYPE_PENDING"		, "pending");
defined('C_STORETYPE_ENABLED') ? null : 		define("C_STORETYPE_ENABLED"		, "enabled");
defined('C_STORETYPE_DATETIME') ? null :		define("C_STORETYPE_DATETIME"		, "datetime");

// ----------------------------------------- PRODUCT TYPES TABLE  ------------------------------------------------------- \\
defined('T_PRODUCTTYPES') ? null :				define("T_PRODUCTTYPES"				, "producttypes");
defined('C_PRODUCTTYPE_ID') ? null : 			define("C_PRODUCTTYPE_ID"			, "id");
defined('C_PRODUCTTYPE_NAME') ? null : 			define("C_PRODUCTTYPE_NAME"			, "name");
defined('C_PRODUCTTYPE_DESCRIPTION') ? null : 	define("C_PRODUCTTYPE_DESCRIPTION"	, "description");
defined('C_PRODUCTTYPE_PICTURE') ? null : 		define("C_PRODUCTTYPE_PICTURE"		, "picture");
defined('C_PRODUCTTYPE_PENDING') ? null : 		define("C_PRODUCTTYPE_PENDING"		, "pending");
defined('C_PRODUCTTYPE_ENABLED') ? null : 		define("C_PRODUCTTYPE_ENABLED"		, "enabled");
defined('C_PRODUCTTYPE_DATETIME') ? null :		define("C_PRODUCTTYPE_DATETIME"		, "datetime");

// ----------------------------------------- PRODUCT PICTURES TABLE  ------------------------------------------------------- \\
defined('T_PRODUCTPICS') ? null :				define("T_PRODUCTPICS"				, "productpics");
defined('C_PRODUCTPIC_ID') ? null : 			define("C_PRODUCTPIC_ID"			, "id");
defined('C_PRODUCTPIC_PRODUCTID') ? null : 		define("C_PRODUCTPIC_PRODUCTID"		, "productid");
defined('C_PRODUCTPIC_PICTURE') ? null : 		define("C_PRODUCTPIC_PICTURE"		, "picture");
defined('C_PRODUCTPIC_PENDING') ? null : 		define("C_PRODUCTPIC_PENDING"		, "pending");
defined('C_PRODUCTPIC_ENABLED') ? null : 		define("C_PRODUCTPIC_ENABLED"		, "enabled");
defined('C_PRODUCTPIC_DATETIME') ? null :		define("C_PRODUCTPIC_DATETIME"		, "datetime");

// ----------------------------------------- STORE PICTURES TABLE  ------------------------------------------------------- \\
defined('T_STOREPICS') ? null :					define("T_STOREPICS"				, "storepics");
defined('C_STOREPIC_ID') ? null : 				define("C_STOREPIC_ID"				, "id");
defined('C_STOREPIC_STOREID') ? null : 			define("C_STOREPIC_STOREID"			, "storeid");
defined('C_STOREPIC_PICTURE') ? null : 			define("C_STOREPIC_PICTURE"			, "picture");
defined('C_STOREPIC_PENDING') ? null : 			define("C_STOREPIC_PENDING"			, "pending");
defined('C_STOREPIC_ENABLED') ? null : 			define("C_STOREPIC_ENABLED"			, "enabled");
defined('C_STOREPIC_DATETIME') ? null :			define("C_STOREPIC_DATETIME"		, "datetime");

// ----------------------------------------- REVIEWS TABLE  ------------------------------------------------------- \\
defined('T_REVIEWS') ? null :					define("T_REVIEWS"					, "reviews");
defined('C_REVIEW_ID') ? null : 				define("C_REVIEW_ID"				, "id");
defined('C_REVIEW_USERID') ? null : 			define("C_REVIEW_USERID"			, "userid");
defined('C_REVIEW_ITEMID') ? null : 			define("C_REVIEW_ITEMID"			, "itemid");
defined('C_REVIEW_ITEMTYPE') ? null : 			define("C_REVIEW_ITEMTYPE"			, "itemtype");
defined('C_REVIEW_REVIEW') ? null : 			define("C_REVIEW_REVIEW"			, "review");
defined('C_REVIEW_RATING') ? null : 			define("C_REVIEW_RATING"			, "rating");
defined('C_REVIEW_PENDING') ? null : 			define("C_REVIEW_PENDING"			, "pending");
defined('C_REVIEW_ENABLED') ? null : 			define("C_REVIEW_ENABLED"			, "enabled");
defined('C_REVIEW_DATETIME') ? null :			define("C_REVIEW_DATETIME"			, "datetime");
	
// ----------------------------------------- TRAFFICS TABLE  ------------------------------------------------------- \\
defined('T_TRAFFICS') ? null :					define("T_TRAFFICS"					, "traffics");
defined('C_TRAFFIC_ID') ? null : 				define("C_TRAFFIC_ID"				, "id");
defined('C_TRAFFIC_USERID') ? null : 			define("C_TRAFFIC_USERID"			, "userid");
defined('C_TRAFFIC_STOREID') ? null : 			define("C_TRAFFIC_STOREID"			, "storeid");
defined('C_TRAFFIC_STATUS') ? null : 			define("C_TRAFFIC_STATUS"			, "status");
defined('C_TRAFFIC_COMMENT') ? null : 			define("C_TRAFFIC_COMMENT"			, "comment");
defined('C_TRAFFIC_LONGITUDE') ? null : 		define("C_TRAFFIC_LONGITUDE"		, "longitude");
defined('C_TRAFFIC_LATITUDE') ? null : 			define("C_TRAFFIC_LATITUDE"			, "latitude");
defined('C_TRAFFIC_PICTURE') ? null : 			define("C_TRAFFIC_PICTURE"			, "picture");
defined('C_TRAFFIC_PENDING') ? null : 			define("C_TRAFFIC_PENDING"			, "pending");
defined('C_TRAFFIC_ENABLED') ? null : 			define("C_TRAFFIC_ENABLED"			, "enabled");
defined('C_TRAFFIC_DATETIME') ? null :			define("C_TRAFFIC_DATETIME"			, "datetime");

// ----------------------------------------- FEATURED ITEMS TABLE  ------------------------------------------------------- \\
defined('T_FEATUREDITEMS') ? null :				define("T_FEATUREDITEMS"			, "featureditems");
defined('C_FEATUREDITEM_ID') ? null : 			define("C_FEATUREDITEM_ID"			, "id");
defined('C_FEATUREDITEM_ITEMID') ? null : 		define("C_FEATUREDITEM_ITEMID"		, "itemid");
defined('C_FEATUREDITEM_ITEMTYPE') ? null : 	define("C_FEATUREDITEM_ITEMTYPE"	, "itemtype");
defined('C_FEATUREDITEM_PICTURE') ? null : 		define("C_FEATUREDITEM_PICTURE"		, "picture");
defined('C_FEATUREDITEM_PRIORITY') ? null : 	define("C_FEATUREDITEM_PRIORITY"	, "priority");
defined('C_FEATUREDITEM_OVERRIDE') ? null : 	define("C_FEATUREDITEM_OVERRIDE"	, "override");
defined('C_FEATUREDITEM_PENDING') ? null : 		define("C_FEATUREDITEM_PENDING"		, "pending");
defined('C_FEATUREDITEM_ENABLED') ? null : 		define("C_FEATUREDITEM_ENABLED"		, "enabled");
defined('C_FEATUREDITEM_DATETIME') ? null :		define("C_FEATUREDITEM_DATETIME"	, "datetime");

// ----------------------------------------- ITEM PICS TABLE  ------------------------------------------------------- \\
defined('T_ITEMPICS') ? null :					define("T_ITEMPICS"					, "itempics");
defined('C_ITEMPIC_ID') ? null : 				define("C_ITEMPIC_ID"				, "id");
defined('C_ITEMPIC_ITEMID') ? null : 			define("C_ITEMPIC_ITEMID"			, "itemid");
defined('C_ITEMPIC_ITEMTYPE') ? null : 			define("C_ITEMPIC_ITEMTYPE"			, "itemtype");
defined('C_ITEMPIC_PICTURE') ? null : 			define("C_ITEMPIC_PICTURE"			, "picture");
defined('C_ITEMPIC_PENDING') ? null : 			define("C_ITEMPIC_PENDING"			, "pending");
defined('C_ITEMPIC_ENABLED') ? null : 			define("C_ITEMPIC_ENABLED"			, "enabled");
defined('C_ITEMPIC_DATETIME') ? null :			define("C_ITEMPIC_DATETIME"			, "datetime");

// ----------------------------------------- SUPERADMINS TABLE  ------------------------------------------------------- \\
defined('T_SUPERADMINS') ? null :				define("T_SUPERADMINS"				, "superadmins");
defined('C_SUPERADMIN_ID') ? null : 			define("C_SUPERADMIN_ID"			, "id");
defined('C_SUPERADMIN_USERID') ? null : 		define("C_SUPERADMIN_USERID"		, "userid");
defined('C_SUPERADMIN_PENDING') ? null : 		define("C_SUPERADMIN_PENDING"		, "pending");
defined('C_SUPERADMIN_ENABLED') ? null : 		define("C_SUPERADMIN_ENABLED"		, "enabled");
defined('C_SUPERADMIN_DATETIME') ? null :		define("C_SUPERADMIN_DATETIME"		, "datetime");

// ----------------------------------------- LOGS TABLE  ------------------------------------------------------- \\
defined('T_LOGS') ? null :						define("T_LOGS"						, "logs");
defined('C_LOGS_ID') ? null : 					define("C_LOGS_ID"					, "id");
defined('C_LOGS_USERID') ? null : 				define("C_LOGS_USERID"				, "userid");
defined('C_LOGS_IP') ? null : 					define("C_LOGS_IP"					, "ip");
defined('C_LOGS_PLATFORM') ? null : 			define("C_LOGS_PLATFORM"			, "platform");
defined('C_LOGS_DATETIME') ? null : 			define("C_LOGS_DATETIME"			, "datetime");
defined('C_LOGS_ACTION') ? null : 				define("C_LOGS_ACTION"				, "action");

// ----------------------------------------- ITEM TYPES ------------------------------------------------------- \\
defined('USER') ? null :						define("USER"						, "USER");
defined('STORE') ? null :						define("STORE"						, "STORE");
defined('PRODUCT') ? null :						define("PRODUCT"					, "PRODUCT");

// ----------------------------------------- GENDERS ------------------------------------------------------- \\
defined('MALE') ? null : 						define("MALE"							, 1);
defined('FEMALE') ? null : 						define("FEMALE"							, 2);

// ----------------------------------------- ACCESS ------------------------------------------------------- \\
defined('ENABLED') ? null : 					define("ENABLED"						, 1);
defined('DISABLED') ? null : 					define("DISABLED"						, 0);

// ----------------------------------------- STATUS ------------------------------------------------------- \\
defined('PENDING') ? null : 					define("PENDING"						, 1);
defined('NOTPENDING') ? null : 					define("NOTPENDING"						, 0);

// ----------------------------------------- PHP MAILER  ------------------------------------------------------- \\

defined('EMAIL_PASS') ? null : 					define("EMAIL_PASS"					, "");
defined('EMAIL_ADDRESS') ? null : 				define("EMAIL_ADDRESS"				, "");

// ----------------------------------------- FACEBOOK PHP SDK  ------------------------------------------------------- \\

defined('FBAPP_ID') ? null : 					define("FBAPP_ID"					, "676117652400921");
defined('FBAPP_SECRET') ? null : 				define("FBAPP_SECRET"				, "d2a36ad2becb2eb9ffdc3e327cd66e36");

// ----------------------------------------- TWITTER SDK  ------------------------------------------------------- \\

defined('CONSUMER_KEY') ? null : 				define("CONSUMER_KEY"				, "kqFZrzh5vV1XWDeQQvjKg");
defined('CONSUMER_SECRET') ? null : 			define("CONSUMER_SECRET"			, "eLFiRdIrgEk61eYmU529tgzraswTwugOVrks0HTSGaw");
defined('OAUTH_CALLBACK') ? null : 				define("OAUTH_CALLBACK"				, "http://epicue.kellyescape.com/includes/webservices/twitteroauth/callback.php");

// ----------------------------------------- RECAPTCHA KEYS  ------------------------------------------------------- \\

defined('RECAPTCHA_PUBLIC') ? null : 			define("RECAPTCHA_PUBLIC"			, "6Lcgl-MSAAAAAF6J4o0d0rmrbx0cVc8nsyoT38XH");
defined('RECAPTCHA_PRIVATE') ? null : 			define("RECAPTCHA_PRIVATE"			, "6Lcgl-MSAAAAAHHYvj1hzBmO47kmsVxccvL52jo2");

defined('PUSHAPPID') ? null : 					define("PUSHAPPID"					, "4170-5aa092r1ee29405f98r0oM4c08087126s06");
defined('PUSHPWD') ? null : 					define("PUSHPWD"					, "QU8was3NB");

?>