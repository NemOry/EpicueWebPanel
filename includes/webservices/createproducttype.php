<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['name']) && $_POST['name'] != ""
  )
{
    $producttype = new ProductType();
    $producttype->name          = $_POST['name'];
    $producttype->description   = $_POST['description'];
    $producttype->pending       = $_POST['pending'];
    $producttype->enabled       = $_POST['enabled'];

    if(isset($_FILES['picture']))
    {
      $file           = new File($_FILES['picture']);
      $producttype->picture  = $file->data;
    }

    $producttype->create();

    $log = new Log($session->userid, $clientip, "WEB", "CREATED PRODUCT TYPE: ".$producttype->id); $log->create();

    $message .= "success";
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>