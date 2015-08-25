<?php 

  require_once("../../includes/initialize.php");

  if(!$session->is_logged_in())
  {
    header("location: ../../index.php");
  }
  else
  {
    $log = new Log($session->userid, $clientip, "WEB", "LOGGED OUT"); $log->create();

    $session->logout();

    header("location: ../../index.php");
  }

?>