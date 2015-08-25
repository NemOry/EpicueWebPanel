<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['productid']) && $_POST['productid'] != "" &&
  isset($_POST['name']) && $_POST['name'] != "" &&
  isset($_POST['price']) && $_POST['price'] != "" &&
  isset($_POST['producttypeid']) && $_POST['producttypeid'] != ""
  )
{
    $object                = Product::get_by_id($_POST['productid']);
    $object->storeid       = $_POST['storeid'];
    $object->name          = $_POST['name'];
    $object->description   = $_POST['description'];
    $object->price         = $_POST['price'];
    $object->producttypeid = $_POST['producttypeid'];
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

    $log = new Log($session->userid, $clientip, "WEB", "UPDATED PRODUCT: ".$object->id); $log->create();

    $message .= "success";
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>