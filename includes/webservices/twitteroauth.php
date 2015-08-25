<?php 

require_once("../initialize.php");

$redirect_uri 	= "http://epicue.kellyescape.com/includes/webservices/twitteroauth.php";

$oauthcallback 		= 'http://epicue.kellyescape.com/includes/webservices/twitteroauth.php';
$consumerkey 		= 'kqFZrzh5vV1XWDeQQvjKg';
$consumersecret 	= 'eLFiRdIrgEk61eYmU529tgzraswTwugOVrks0HTSGaw';
$accesstoken 		= '88670422-l0PHzTWZuDboueua2vqjC3bYIEV71zc3Ksg14M883';
$accesstokensecret 	= 'XJJva5yw3nZl0yZUWGydECXnHhcrsHApQ7jwOADeYc';

$connection = new TwitterOAuth($consumerkey, $consumersecret);

$connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

$temporary_credentials = $connection->getRequestToken($oauthcallback);

$redirect_url1 = $connection->getAuthorizeURL($temporary_credentials); // Use Sign in with Twitter
$redirect_url2 = $connection->getAuthorizeURL($temporary_credentials, FALSE);

echo "$redirect_url1: ".$redirect_url1."<br />";
echo "$redirect_url2: ".$redirect_url2."<br />";

?>

<script>
	navigator.cascades.postMessage("<?php echo $userid; ?>");
	navigator.cascades.postMessage("<?php echo $access_token; ?>");
</script>