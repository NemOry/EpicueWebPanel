<?php

require_once("../../includes/initialize.php");

global $session;

if(!$session->is_logged_in())
{
    redirect_to("../../index.php");
}

if($_POST['oper']=='add')
{
	$log 			= new Log(0, "", "", "");
	$log->userid 	= $_POST['userid'];
	$log->ip 		= $_POST['ip'];
	$log->platform 	= $_POST['platform'];
	$log->action 	= $_POST['action'];
	$log->create();

	$log = new Log($session->userid, $clientip, "WEB", "CREATED LOG: ".$_POST['id']); $log->create();
}
else if($_POST['oper']=='edit')
{
	$log 			= Log::get_by_id($_POST['id']);
	$log->userid 	= $_POST['userid'];
	$log->ip 		= $_POST['ip'];
	$log->platform 	= $_POST['platform'];
	$log->action 	= $_POST['action'];
	$log->update();

	$log = new Log($session->userid, $clientip, "WEB", "UPDATED LOG: ".$_POST['id']); $log->create();
}
else if($_POST['oper']=='del')
{
	$log = new Log($session->userid, $clientip, "WEB", "DELETED LOG: ".$_POST['id']); $log->create();
	Log::get_by_id($_POST['id'])->delete();
}

?>