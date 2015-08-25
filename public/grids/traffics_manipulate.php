<?php

require_once("../../includes/initialize.php");

global $session;

if(!$session->is_logged_in())
{
    redirect_to("../../index.php");
}

if($_POST['oper']=='add')
{
	$object 		     = new Traffic();
	$object->userid    = $_POST['userid'];
    $object->storeid   = $_POST['storeid'];
    $object->status    = $_POST['status'];
    $object->comment   = $_POST['comment'];
    $object->pending   = $_POST['pending'];
    $object->enabled   = $_POST['enabled'];
	$object->create();

	$log = new Log($session->userid, $clientip, "WEB", "CREATED TRAFFIC: ".$_POST['id']); $log->create();
}
else if($_POST['oper']=='edit')
{
	$object 		= Traffic::get_by_id($_POST['id']);
	$object->userid    = $_POST['userid'];
    $object->storeid   = $_POST['storeid'];
    $object->status    = $_POST['status'];
    $object->comment   = $_POST['comment'];
    $object->pending   = $_POST['pending'];
    $object->enabled   = $_POST['enabled'];
	$object->update();

	$log = new Log($session->userid, $clientip, "WEB", "UPDATED TRAFFIC: ".$_POST['id']); $log->create();
}
else if($_POST['oper']=='del')
{
	if($_POST['id'] != $session->userid)
	{
		$log = new Log($session->userid, $clientip, "WEB", "DELETED TRAFFIC: ".$_POST['id']); $log->create();

		Traffic::get_by_id($_POST['id'])->delete();
	}
}

?>