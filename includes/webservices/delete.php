<?php

require_once("../initialize.php");

$message = "";

if(isset($_GET['itemid']) && isset($_GET['itemtype']))
{
  $message = "success";

  if($_GET['itemtype'] == "user")
  {
    User::get_by_id($_GET['itemid'])->delete();
  }
  else if($_GET['itemtype'] == "store")
  {
    Store::get_by_id($_GET['itemid'])->delete();
  }
  else if($_GET['itemtype'] == "storetype")
  {
    StoreType::get_by_id($_GET['itemid'])->delete();
  }
  else if($_GET['itemtype'] == "storepic")
  {
    StorePic::get_by_id($_GET['itemid'])->delete();
  }
  else if($_GET['itemtype'] == "product")
  {
    Product::get_by_id($_GET['itemid'])->delete();
  }
  else if($_GET['itemtype'] == "producttype")
  {
    ProductType::get_by_id($_GET['itemid'])->delete();
  }
  else if($_GET['itemtype'] == "productpic")
  {
    ProductPic::get_by_id($_GET['itemid'])->delete();
  }
  else if($_GET['itemtype'] == "traffic")
  {
    Traffic::get_by_id($_GET['itemid'])->delete();
  }
  else if($_GET['itemtype'] == "review")
  {
    Review::get_by_id($_GET['itemid'])->delete();
  }
  else if($_GET['itemtype'] == "featureditem")
  {
    FeaturedItem::get_by_id($_GET['itemid'])->delete();
  }
  else
  {
    $message = "unknown parameter passed";
  }
}
else
{
  $message = "missing required parameter";
}

echo $message;

?>