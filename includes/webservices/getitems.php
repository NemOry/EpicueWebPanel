<?php

require_once("../initialize.php");

$message = "";

if($_GET['itemtype'])
{
  $items = array();
  
  if($_GET['itemtype'] == "store")
  {
    $items = Store::get_all();
  }
  else if($_GET['itemtype'] == "product")
  {
    $items = Product::get_all();
  }

  if(count($items) > 0)
  {
    foreach ($items as $item) 
    {
      echo '<option value="'.$item->id.'">'.$item->name.'</option>';
    }
  }
  else
  {
    $message .= "no items";
  }
}
else
{
  $message .= "no itemtype selected";
}

echo $message;

?>