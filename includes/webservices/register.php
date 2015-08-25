<?php

require_once("../initialize.php");

$message = "";

if(
      isset($_POST['username']) && 
      isset($_POST['password']) && 
      isset($_POST['email']) && 
      $_POST['username'] !="" && 
      $_POST['password'] !="" && 
      $_POST['email'] !=""
    )
  {
    $username_exists  = User::username_exists($_POST['username']);
    $email_exists     = false;

    if(isset($_POST['email']) && $_POST['email'] != "")
    {
      $email_exists = User::email_exists($_POST['email']);
    }

    if($username_exists)
    {
      $message .= "Sorry, the username: ".$_POST['username']." is already taken. Please choose a different one.";
    }

    if($email_exists)
    {
      $message .= "Sorry, the email: ".$_POST['email']." is already registered.";
    }

    if($message == "")
    {
      $user = new User();
      $user->username   = $_POST['username'];
      $user->password   = $_POST['password'];
      $user->email      = $_POST['email'];
      $user->firstname  = "";
      $user->middlename = "";
      $user->lastname   = "";
      $user->birthdate  = "";
      $user->gender     = 1;
      $user->pending    = 0;
      $user->enabled    = 1;

      $user->create();

      $message .= $user->id;
    }
  }
  else
  {
    $message = "ERROR: All fields are required.";
  }

  echo $message;

?>