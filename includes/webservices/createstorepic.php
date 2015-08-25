<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['storeid']) && $_POST['storeid'] != ""
  )
{
    $storepic           = new StorePic();
    $storepic->storeid  = $_POST['storeid'];

    if(isset($_FILES['picture']))
    {
      $file           = new File($_FILES['picture']);
      $storepic->picture  = $file->data;
      $storepic->create();
      $log = new Log($session->userid, $clientip, "WEB", "UPLOADED STORE PIC: ".$storepic->id); $log->create();

      $message .= "success";
    }
    else
    {
      $message .= "please select a photo";
    } 
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>