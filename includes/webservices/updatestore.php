<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['name']) && $_POST['name'] != "" &&
  isset($_POST['address']) && $_POST['address'] != "" &&
  isset($_POST['storeid']) && $_POST['storeid'] != ""
  )
{
    $object                = Store::get_by_id($_POST['storeid']);
    $object->name          = $_POST['name'];
    $object->branchname    = $_POST['branchname'];
    $object->address       = $_POST['address'];
    $object->longitude     = $_POST['longitude'];
    $object->latitude      = $_POST['latitude'];
    $object->telnum        = $_POST['telnum'];
    $object->deliverynum   = $_POST['deliverynum'];
    $object->email         = $_POST['email'];
    $object->storetypeid   = $_POST['storetypeid'];
    $object->facebookid    = $_POST['facebookid'];
    $object->twitterid     = $_POST['twitterid'];
    $object->pending       = $_POST['pending'];
    $object->enabled       = $_POST['enabled'];

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

    $log = new Log($session->userid, $clientip, "WEB", "UPDATED STORE: ".$object->id); $log->create();

    $message .= "success";
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>