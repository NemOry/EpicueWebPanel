<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['itemid']) && $_POST['itemid'] != "" &&
  isset($_POST['itemtype']) && $_POST['itemtype'] != ""
  )
{
    $object                = new ItemPic();
    $object->itemid        = $_POST['itemid'];
    $object->itemtype      = $_POST['itemtype'];
    $object->pending       = $_POST['pending'];
    $object->enabled       = $_POST['enabled'];

    if(isset($_FILES['picture']))
    {
      $file             = new File($_FILES['picture']);
      $object->picture  = $file->data;
    }

    $object->create();

    $log = new Log($session->userid, $clientip, "WEB", "CREATED ITEM PIC: ".$object->id); $log->create();

    $message .= "success";
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>