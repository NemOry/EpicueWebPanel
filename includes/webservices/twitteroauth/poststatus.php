<?php

require_once("../../initialize.php");

$access_token 			= $_GET['access_token'];
$access_token_secret 	= $_GET['access_token_secret'];

$message 				= $_POST['message'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);

$account = $connection->get('account/verify_credentials');
$status = $connection->post('statuses/update', array('status' => $message));

echo "success";

?>