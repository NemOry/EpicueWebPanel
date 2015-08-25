<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['username']) && $_POST['username'] != "" &&
  isset($_POST['password']) && $_POST['password'] != "" &&
  isset($_POST['email']) && $_POST['email'] != "" &&
  isset($_POST['firstname']) && $_POST['firstname'] != "" &&
  isset($_POST['lastname']) && $_POST['lastname'] != ""
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
    $message .= "Sorry, the username: <i><b>".$_POST['username']."</b></i> is already taken. Please choose a different one.<br />";
  }

  if($email_exists)
  {
    $message .= "Sorry, the email: <i><b>".$_POST['email']."</b></i> is already registered.";
  }

  if($message == "")
  {
    $user = new User();
    $user->username   = $_POST['username'];
    $user->password   = $_POST['password'];
    $user->email      = $_POST['email'];
    $user->firstname  = $_POST['firstname'];
    $user->middlename = $_POST['middlename'];
    $user->lastname   = $_POST['lastname'];
    $user->birthdate  = $_POST['birthdate'];
    $user->gender     = $_POST['gender'];
    $user->pending    = $_POST['pending'];
    $user->enabled    = $_POST['enabled'];

    if(isset($_FILES['picture']))
    {
      $file           = new File($_FILES['picture']);
      $user->picture  = $file->data;
    }

    $user->create();

    $log = new Log($user->id, $clientip, "WEB", "CREATED USER: ".$user->id); $log->create();

    $message .= "success";
  }
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>