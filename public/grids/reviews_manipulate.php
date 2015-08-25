<?php

require_once("../../includes/initialize.php");

global $session;

if(!$session->is_logged_in())
{
    redirect_to("../../index.php");
}

if($_POST['oper']=='add')
{
	$object 		     = new Review();
	$object->userid   = $_POST['userid'];
    $object->itemid   = $_POST['itemid'];
    $object->itemtype = $_POST['itemtype'];
    $object->review   = $_POST['review'];
    $object->rating   = $_POST['rating'];
    $object->pending  = $_POST['pending'];
    $object->enabled  = $_POST['enabled'];
	$object->create();

	$log = new Log($session->userid, $clientip, "WEB", "CREATED REVIEW: ".$_POST['id']); $log->create();
}
else if($_POST['oper']=='edit')
{
	$object 		= Review::get_by_id($_POST['id']);
	$object->userid   = $_POST['userid'];
    $object->itemid   = $_POST['itemid'];
    $object->itemtype = $_POST['itemtype'];
    $object->review   = $_POST['review'];
    $object->rating   = $_POST['rating'];
    $object->pending  = $_POST['pending'];
    $object->enabled  = $_POST['enabled'];
	$object->update();

	$log = new Log($session->userid, $clientip, "WEB", "UPDATED REVIEW: ".$_POST['id']); $log->create();
}
else if($_POST['oper']=='del')
{
	if($_POST['id'] != $session->userid)
	{
		$log = new Log($session->userid, $clientip, "WEB", "DELETED REVIEW: ".$_POST['id']); $log->create();

		Review::get_by_id($_POST['id'])->delete();
	}
}

?>