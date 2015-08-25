<?php

require_once("../../includes/initialize.php");

global $session;

if(!$session->is_logged_in())
{
    redirect_to("../../index.php");
}

if($_POST['oper']=='add')
{
	$user 			  	= new User();
	$user->username   	= $_POST['username'];
	$user->password   	= $_POST['password'];
	$user->email      	= $_POST['email'];
	$user->firstname  	= $_POST['firstname'];
	$user->middlename 	= $_POST['middlename'];
	$user->lastname   	= $_POST['lastname'];
	$user->birthdate  	= $_POST['birthdate'];
	$user->gender     	= $_POST['gender'];
	$user->twitterid 	= $_POST['twitterid'];
	$user->facebookid   = $_POST['facebookid'];
	$user->foursquareid = $_POST['foursquareid'];
	$user->scoreloopid  = $_POST['scoreloopid'];
	$user->pending    	= $_POST['pending'];
	$user->enabled    	= $_POST['enabled'];
	$user->create();

	$log = new Log($session->userid, $clientip, "WEB", "CREATED USER: ".$_POST['id']); $log->create();
}
else if($_POST['oper']=='edit')
{
	$user 			  = User::get_by_id($_POST['id']);
	$user->username   	= $_POST['username'];
	$user->password   	= $_POST['password'];
	$user->email      	= $_POST['email'];
	$user->firstname  	= $_POST['firstname'];
	$user->middlename 	= $_POST['middlename'];
	$user->lastname   	= $_POST['lastname'];
	$user->birthdate  	= $_POST['birthdate'];
	$user->gender     	= $_POST['gender'];
	$user->twitterid 	= $_POST['twitterid'];
	$user->facebookid   = $_POST['facebookid'];
	$user->foursquareid = $_POST['foursquareid'];
	$user->scoreloopid  = $_POST['scoreloopid'];
	$user->pending    	= $_POST['pending'];
	$user->enabled    	= $_POST['enabled'];
	$user->update();

	$log = new Log($session->userid, $clientip, "WEB", "UPDATED USER: ".$_POST['id']); $log->create();
}
else if($_POST['oper']=='del')
{
	if($_POST['id'] != $session->userid)
	{
		$log = new Log($session->userid, $clientip, "WEB", "DELETED USER: ".$_POST['id']); $log->create();

		User::get_by_id($_POST['id'])->delete();
	}
}

?>