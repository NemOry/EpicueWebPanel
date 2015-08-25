<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['trafficid']) && $_POST['trafficid'] != "" &&
  isset($_POST['status']) && $_POST['status'] != "" &&
  isset($_POST['userid']) && $_POST['userid'] != "" &&
  isset($_POST['storeid']) && $_POST['storeid'] != ""
  )
{
    $object            = Traffic::get_by_id($_POST['trafficid']);
    $object->userid    = $_POST['userid'];
    $object->storeid   = $_POST['storeid'];
    $object->status    = $_POST['status'];
    $object->longitude = $_POST['longitude'];
    $object->latitude  = $_POST['latitude'];
    $object->comment   = $_POST['comment'];
    $object->pending   = $_POST['pending'];
    $object->enabled   = $_POST['enabled'];

    $file = new File($_FILES['picture']);

    if($file->valid)
    {
      $object->picture  = $file->data;
    }
    else
    {
      $object->picture  = base64_decode($object->picture);
    }

    $object->update();

    $log = new Log($session->userid, $clientip, "WEB", "UPDATED TRAFFIC: ".$object->id); $log->create();

    $message .= "success";
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>