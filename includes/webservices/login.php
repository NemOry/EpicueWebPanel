<?php

require_once("../initialize.php");

$message = "";

if(
      isset($_POST['email']) && 
      isset($_POST['password']) && 
      $_POST['email'] !="" && 
      $_POST['password'] !=""
    )
  {

    if(isset($_GET['username']))
    {
      $user = User::login($_POST['username'], $_POST['password']);
    }
    else
    {
      $user = User::loginEmail($_POST['email'], $_POST['password']);
    }

    if($user)
    {
      if($user->enabled == 1)
      {
        $message .= $user->id;
      }
      else
      {
        $message = "ERROR: Sorry that you can\'t login right now. Your account has been disabled by the admin for some reason.";
      }
    }
    else
    {
      $message = "ERROR: Wrong Credentials.";
    }
  }
  else
  {
    $message = "ERROR: Please enter an email and a password.";
  }

  echo $message;

?>