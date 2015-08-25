<?php 

require_once("../initialize.php");

$code = $_GET['code'];

$redirect_uri 	= "http://epicue.kellyescape.com/includes/webservices/facebookoauth.php";
$client_id 		= "676117652400921";
$client_secret 	= "d2a36ad2becb2eb9ffdc3e327cd66e36";

$urlAuthorize 		= "https://graph.facebook.com/oauth/authorize?client_id=".$client_id."&scope=offline_access,publish_stream&redirect_uri=".$redirect_uri;
$urlGetAccessToken 	= "https://graph.facebook.com/oauth/access_token?fields=id&client_id=".$client_id."&redirect_uri=".$redirect_uri."&client_secret=".$client_secret."&code=".$code;
$urlPostWall 		= "https://graph.facebook.com/me/feed?access_token=".$access_token;

$access_token = curl($urlGetAccessToken);

$start = strpos($access_token , "=");
$end = strpos($access_token , "&");

$access_token = substr($access_token, $start + 1);

$urlGetID = "https://graph.facebook.com/me?fields=id&access_token=".$access_token;

$userid = curl($urlGetID);

$userid = json_decode($userid )->{'id'};

echo "<p style='font-size:50px;'>Finishing... Please wait...</p>";

function curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

?>

<script>
	navigator.cascades.postMessage("<?php echo $userid; ?>");
	navigator.cascades.postMessage("<?php echo $access_token; ?>");
</script>