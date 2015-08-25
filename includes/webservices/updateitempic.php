<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['itemid']) && $_POST['itemid'] != "" &&
  isset($_POST['itemtype']) && $_POST['itemtype'] != ""
  )
{
    $object            = ItemPic::get_by_id($_POST['itempicid']);
    $object->itemid    = $_POST['itemid'];
    $object->itemtype  = $_POST['itemtype'];
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

    $log = new Log($session->userid, $clientip, "WEB", "UPDATED ITEM PIC: ".$object->id); $log->create();

    $message .= "success";
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>