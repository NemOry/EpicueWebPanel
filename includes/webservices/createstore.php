<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['name']) && $_POST['name'] != "" &&
  isset($_POST['address']) && $_POST['address'] != ""
  )
{
    $object = new Store();
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

    if(isset($_FILES['picture']))
    {
      $file           = new File($_FILES['picture']);
      $object->picture  = $file->data;
    }

    $object->create();

    //$log = new Log($session->userid, $clientip, "WEB", "CREATED STORE: ".$object->id); $log->create();

    $message .= "success";
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>