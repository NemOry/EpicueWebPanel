<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['review']) && $_POST['review'] != "" &&
  isset($_POST['rating']) && $_POST['rating'] != "" &&
  isset($_POST['userid']) && $_POST['userid'] != "" &&
  isset($_POST['itemid']) && $_POST['itemid'] != "" &&
  isset($_POST['itemtype']) && $_POST['itemtype'] != ""
  )
{
    $review           = new Review();
    $review->userid   = $_POST['userid'];
    $review->itemid   = $_POST['itemid'];
    $review->itemtype = $_POST['itemtype'];
    $review->review   = $_POST['review'];
    $review->rating   = $_POST['rating'];
    $review->pending  = $_POST['pending'];
    $review->enabled  = $_POST['enabled'];

    if(isset($_FILES['picture']))
    {
      $file              = new File($_FILES['picture']);
      $review->picture  = $file->data;
    }

    $review->create();

    $log = new Log($session->userid, $clientip, "WEB", "CREATED REVIEW: ".$review->id); $log->create();

    $message .= "success";
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>