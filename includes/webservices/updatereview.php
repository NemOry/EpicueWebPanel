<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['userid']) && $_POST['userid'] != "" &&
  isset($_POST['itemid']) && $_POST['itemid'] != "" &&
  isset($_POST['itemtype']) && $_POST['itemtype'] != "" &&
  isset($_POST['rating']) && $_POST['rating'] != "" &&
  isset($_POST['review']) && $_POST['review'] != ""
  )
{
    $object            = Review::get_by_id($_POST['reviewid']);
    $object->userid    = $_POST['userid'];
    $object->itemid    = $_POST['itemid'];
    $object->itemtype  = $_POST['itemtype'];
    $object->review    = $_POST['review'];
    $object->rating    = $_POST['rating'];
    $object->pending   = $_POST['pending'];
    $object->enabled   = $_POST['enabled'];

    $object->update();

    $log = new Log($session->userid, $clientip, "WEB", "UPDATED REVIEW: ".$object->id); $log->create();

    $message .= "success";
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>