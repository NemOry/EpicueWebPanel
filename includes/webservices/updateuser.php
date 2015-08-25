<?php

require_once("../initialize.php");

$message = "";

if(
  isset($_POST['userid']) && $_POST['userid'] != "" &&
  isset($_POST['username']) && $_POST['username'] != "" &&
  isset($_POST['password']) && $_POST['password'] != "" &&
  isset($_POST['email']) && $_POST['email'] != "" &&
  isset($_POST['firstname']) && $_POST['firstname'] != "" &&
  isset($_POST['lastname']) && $_POST['lastname'] != ""
  )
{
  $object = User::get_by_id($_POST['userid']);

  $username_exists = false;
  $email_exists = false;

  if($_POST['username'] != $object->username)
  {
    $username_exists  = User::username_exists($_POST['username']);
  }

  if($_POST['email'] != $object->email)
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
    $object->username   = $_POST['username'];
    $object->password   = $_POST['password'];
    $object->email      = $_POST['email'];
    $object->firstname  = $_POST['firstname'];
    $object->middlename = $_POST['middlename'];
    $object->lastname   = $_POST['lastname'];
    $object->birthdate  = $_POST['birthdate'];
    $object->gender     = $_POST['gender'];

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

    $log = new Log($object->id, $clientip, "WEB", "UPDATED USER: ".$object->id); $log->create();

    $message .= "success";
  }
}
else
{
  $message = "You have missed a required field.";
}

echo $message;

?>