<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['name']) && $_POST['name'] != ""
  )
{
    $storetype = new StoreType();
    $storetype->name          = $_POST['name'];
    $storetype->description   = $_POST['description'];
    $storetype->pending       = $_POST['pending'];
    $storetype->enabled       = $_POST['enabled'];

    if(isset($_FILES['picture']))
    {
      $file           = new File($_FILES['picture']);
      $storetype->picture  = $file->data;
    }

    $storetype->create();

    $log = new Log($session->userid, $clientip, "WEB", "CREATED STORE TYPE: ".$storetype->id); $log->create();

    $message .= "success";
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>