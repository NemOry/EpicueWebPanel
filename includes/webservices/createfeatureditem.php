<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['itemid']) && $_POST['itemid'] != "" &&
  isset($_POST['itemtype']) && $_POST['itemtype'] != ""
  )
{
  if(!FeaturedItem::exists($_POST['itemid'], $_POST['itemtype']))
  {
    $object                = new FeaturedItem();
    $object->itemid        = $_POST['itemid'];
    $object->itemtype      = $_POST['itemtype'];
    $object->priority      = $_POST['priority'];
    $object->override      = $_POST['override'];
    $object->pending       = $_POST['pending'];
    $object->enabled       = $_POST['enabled'];

    if(isset($_FILES['picture']))
    {
      $file             = new File($_FILES['picture']);
      $object->picture  = $file->data;
    }

    $object->create();

    $log = new Log($session->userid, $clientip, "WEB", "CREATED FEATURED ITEM: ".$object->id); $log->create();

    $message .= "success";
  }
  else
  {
    $message .= "Cannot add a duplicate";
  }  
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>