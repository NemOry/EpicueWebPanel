<?php

require_once("../initialize.php");

$message = "";

if($_GET['storeid'])
{
  $items = array();
  
  $items = Product::get_by_storeid($_GET['storeid']);

  if(count($items) > 0)
  {
    foreach ($items as $item) 
    {
      echo '<option value="'.$item->id.'">'.$item->name.'</option>';
    }
  }
  else
  {
    $message .= "no products in this store";
  }
}
else
{
  $message .= "no store selected";
}

echo $message;

?>