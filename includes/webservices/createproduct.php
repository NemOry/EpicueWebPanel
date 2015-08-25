<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['storeid']) && $_POST['storeid'] != "" &&
  isset($_POST['name']) && $_POST['name'] != "" &&
  isset($_POST['price']) && $_POST['price'] != "" &&
  isset($_POST['producttypeid']) && $_POST['producttypeid'] != ""
  )
{
    $product                = new Product();
    $product->storeid       = $_POST['storeid'];
    $product->name          = $_POST['name'];
    $product->description   = $_POST['description'];
    $product->price         = $_POST['price'];
    $product->producttypeid = $_POST['producttypeid'];
    $product->pending       = $_POST['pending'];
    $product->enabled       = $_POST['enabled'];

    if(isset($_FILES['picture']))
    {
      $file           = new File($_FILES['picture']);
      $product->picture  = $file->data;
    }

    $product->create();

    $log = new Log($session->userid, $clientip, "WEB", "CREATED PRODUCT: ".$product->id); $log->create();

    $message .= "success";
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>