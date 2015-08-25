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
    $object->pending   = $_POST['pending'];
    $object->enabled   = $_POST['enabled'];

    if(isset($_FILES['picture']))
    {
      $file              = new File($_FILES['picture']);
      $object->picture  = $file->data;
    }

    $object->create();

    $log = new Log($session->userid, $clientip, "WEB", "CREATED TRAFFIC: ".$object->id); $log->create();

    $message .= "success";
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>