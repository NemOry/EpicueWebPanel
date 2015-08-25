<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['status']) && $_POST['status'] != "" &&
  isset($_POST['userid']) && $_POST['userid'] != "" &&
  isset($_POST['storeid']) && $_POST['storeid'] != ""
  )
{
    $object            = new Traffic();
    $object->userid    = $_POST['userid'];
    $object->storeid   = $_POST['storeid'];
    $object->status    = $_POST['status'];
    $object->comment   = $_POST['comment'];
    $object->longitude = $_POST['longitude'];
    $object->latitude  = $_POST['latitude'];
    $object->pending   = 0;
    $object->enabled   = 1;

    if(isset($_FILES['picture']))
    {
      $file             = new File($_FILES['picture']);
      $object->picture  = $file->data;
    }

    $object->create();

    if(!$session->is_logged_in()){ $session->userid = 0; }
    $log = new Log($session->userid, $clientip, "WEB", "CREATED TRAFFIC: ".$object->id); $log->create();

    $message .= "success";
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>