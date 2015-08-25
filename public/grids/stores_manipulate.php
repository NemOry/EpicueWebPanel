<?php

require_once("../../includes/initialize.php");

global $session;

if(!$session->is_logged_in())
{
    redirect_to("../../index.php");
}

if($_POST['oper']=='add')
{
	$object 			  = new Store();
	$object->name          = $_POST['name'];
    $object->branchname    = $_POST['branchname'];
    $object->address       = $_POST['address'];
    $object->telnum        = $_POST['telnum'];
    $object->deliverynum   = $_POST['deliverynum'];
    $object->email         = $_POST['email'];
    $object->storetypeid   = $_POST['storetypeid'];
    $object->pending       = $_POST['pending'];
    $object->enabled       = $_POST['enabled'];
	$object->create();

	$log = new Log($session->userid, $clientip, "WEB", "CREATED USER: ".$_POST['id']); $log->create();
}
else if($_POST['oper']=='edit')
{
	$object 			  	= Store::get_by_id($_POST['id']);
	$object->name          = $_POST['name'];
    $object->branchname    = $_POST['branchname'];
    $object->address       = $_POST['address'];
    $object->telnum        = $_POST['telnum'];
    $object->deliverynum   = $_POST['deliverynum'];
    $object->email         = $_POST['email'];
    $object->storetypeid   = $_POST['storetypeid'];
    $object->pending       = $_POST['pending'];
    $object->enabled       = $_POST['enabled'];
	$object->update();

	$log = new Log($session->userid, $clientip, "WEB", "UPDATED STORE: ".$_POST['id']); $log->create();
}
else if($_POST['oper']=='del')
{
	if($_POST['id'] != $session->userid)
	{
		$log = new Log($session->userid, $clientip, "WEB", "DELETED STORE: ".$_POST['id']); $log->create();

		Store::get_by_id($_POST['id'])->delete();
	}
}

?>