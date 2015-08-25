<?php

session_start();

require_once("../../initialize.php");

if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) 
{
  $_SESSION['oauth_status'] = 'oldtoken';
  header('Location: ./clearsessions.php');
}

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);


if (200 == $connection->http_code) 
{
  //echo "VALID";
} 
else 
{
  //echo "ERROR";
}

?>

Finishing... Please wait...

<script>
	navigator.cascades.postMessage("<?php echo $access_token['oauth_token']; ?>");
	navigator.cascades.postMessage("<?php echo $access_token['oauth_token_secret']; ?>");
</script>