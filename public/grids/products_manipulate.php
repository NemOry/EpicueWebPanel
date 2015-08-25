<?php

require_once("../../includes/initialize.php");

global $session;

if(!$session->is_logged_in())
{
    redirect_to("../../index.php");
}

if($_POST['oper']=='add')
{
	$object 			   = new Product();
	$object->storeid       = $_POST['storeid'];
    $object->name          = $_POST['name'];
    $object->description   = $_POST['description'];
    $object->price         = $_POST['price'];
    $object->producttypeid = $_POST['producttypeid'];
    $object->pending       = $_POST['pending'];
    $object->enabled       = $_POST['enabled'];
	$object->create();

	$log = new Log($session->userid, $clientip, "WEB", "CREATED USER: ".$_POST['id']); $log->create();
}
else if($_POST['oper']=='edit')
{
	$object 			   = Product::get_by_id($_POST['id']);
	$object->storeid       = $_POST['storeid'];
    $object->name          = $_POST['name'];
    $object->description   = $_POST['description'];
    $object->price         = $_POST['price'];
    $object->producttypeid = $_POST['producttypeid'];
    $object->pending       = $_POST['pending'];
    $object->enabled       = $_POST['enabled'];
	$object->update();

	$log = new Log($session->userid, $clientip, "WEB", "UPDATED PRODUCT: ".$_POST['id']); $log->create();
}
else if($_POST['oper']=='del')
{
	if($_POST['id'] != $session->userid)
	{
		$log = new Log($session->userid, $clientip, "WEB", "DELETED PRODUCT: ".$_POST['id']); $log->create();

		Product::get_by_id($_POST['id'])->delete();
	}
}

?>