<?php

require_once("../initialize.php");

$html = "";

$input = "";

if(isset($_GET['input']))
{
  $input = $_GET['input'];
}

$filename = 0;

if(isset($_GET['itemtype']))
{
  $items = array();

  if($_GET['itemtype'] == "user")
  {
    $items = User::search($input);

    if(count($items) > 0)
    {
      foreach ($items as $item) 
      {
        $filename++;

        $random = rand(0, 1);

        file_put_contents("images/".$filename."x".$random.".jpg", base64_decode($item->picture));

        $item->picture = HOST."includes/webservices/images/".$filename."x".$random.".jpg";

        $html .= "<tr>";
        $html .= "  <td><img src='".$item->picture."' height='40' width='40'/></td>";
        $html .= "  <td>".$item->username."</td>";
        $html .= "  <td>".$item->get_full_name()."</td>";
        $html .= "  <td><a class='btn btn-primary' href='updateuser.php?id=".$item->id."'>Update</a></td>";
        $html .= "  <td><button class='btn btn-danger btndelete'>Delete <span hidden>".$item->id."</span></button></td>";
        $html .= "</tr>";
      }

      $filename = 0;

      echo $html;
    }
    else
    {
      echo "no data";
    }
  }
  else if($_GET['itemtype'] == "store")
  {
    $items = Store::search($input);

    if(count($items) > 0)
    {
      foreach ($items as $item) 
      {
        $filename++;

        $random = rand(0, 1);

        file_put_contents("images/".$filename."x".$random.".jpg", base64_decode($item->picture));

        $item->picture = HOST."includes/webservices/images/".$filename."x".$random.".jpg";

        $html .= "<tr>";
        $html .= "  <td><img src='".$item->picture."' height='40' width='40'/></td>";
        $html .= "  <td>".$item->name."</td>";
        $html .= "  <td>".$item->branchname."</td>";
        $html .= "  <td><a class='btn btn-primary' href='updatestore.php?id=".$item->id."'>Update</a></td>";
        $html .= "  <td><button class='btn btn-danger btndelete'>Delete <span hidden>".$item->id."</span></button></td>";
        $html .= "</tr>";
      }

      $filename = 0;

      echo $html;
    }
    else
    {
      echo "no data";
    }
  }
  else if($_GET['itemtype'] == "storetype")
  {
    $items = StoreType::search($input);

    if(count($items) > 0)
    {
      foreach ($items as $item) 
      {
        $filename++;

        $random = rand(0, 1);

        file_put_contents("images/".$filename."x".$random.".jpg", base64_decode($item->picture));

        $item->picture = HOST."includes/webservices/images/".$filename."x".$random.".jpg";

        $html .= "<tr>";
        $html .= "  <td><img src='".$item->picture."' height='40' width='40'/></td>";
        $html .= "  <td>".$item->name."</td>";
        $html .= "  <td><a class='btn btn-primary' href='updatestoretype.php?id=".$item->id."'>Update</a></td>";
        $html .= "  <td><button class='btn btn-danger btndelete'>Delete <span hidden>".$item->id."</span></button></td>";
        $html .= "</tr>";
      }

      $filename = 0;

      echo $html;
    }
    else
    {
      echo "no data";
    }
  }
  else if($_GET['itemtype'] == "storepic")
  {
    $items = StorePic::get_all();

    if(count($items) > 0)
    {
      foreach ($items as $item) 
      {
        $filename++;

        $random = rand(0, 1);

        file_put_contents("images/".$filename."x".$random.".jpg", base64_decode($item->picture));

        $item->picture = HOST."includes/webservices/images/".$filename."x".$random.".jpg";

        $html .= "<tr>";
        $html .= "  <td><img src='".$item->picture."' height='40' width='40'/></td>";
        $html .= "  <td>storeid ".$item->storeid."</td>";
        $html .= "  <td><a class='btn btn-primary' href='updatestorepic.php?id=".$item->id."'>Update</a></td>";
        $html .= "  <td><button class='btn btn-danger btndelete'>Delete <span hidden>".$item->id."</span></button></td>";
        $html .= "</tr>";
      }

      $filename = 0;

      echo $html;
    }
    else
    {
      echo "no data";
    }
  }
  else if($_GET['itemtype'] == "product")
  {
    $items = Product::search($input);

    if(count($items) > 0)
    {
      foreach ($items as $item) 
      {
        $filename++;

        $random = rand(0, 1);

        file_put_contents("images/".$filename."x".$random.".jpg", base64_decode($item->picture));

        $item->picture = HOST."includes/webservices/images/".$filename."x".$random.".jpg";

        $html .= "<tr>";
        $html .= "  <td><img src='".$item->picture."' height='40' width='40'/></td>";
        $html .= "  <td>storeid ".$item->storeid."</td>";
        $html .= "  <td>".$item->name."</td>";
        $html .= "  <td>".$item->description."</td>";
        $html .= "  <td><a class='btn btn-primary' href='updateproduct.php?id=".$item->id."'>Update</a></td>";
        $html .= "  <td><button class='btn btn-danger btndelete'>Delete <span hidden>".$item->id."</span></button></td>";
        $html .= "</tr>";
      }

      $filename = 0;

      echo $html;
    }
    else
    {
      echo "no data";
    }
  }
  else if($_GET['itemtype'] == "producttype")
  {
    $items = ProductType::search($input);

    if(count($items) > 0)
    {
      foreach ($items as $item) 
      {
        $filename++;

        $random = rand(0, 1);

        file_put_contents("images/".$filename."x".$random.".jpg", base64_decode($item->picture));

        $item->picture = HOST."includes/webservices/images/".$filename."x".$random.".jpg";

        $html .= "<tr>";
        $html .= "  <td><img src='".$item->picture."' height='40' width='40'/></td>";
        $html .= "  <td>".$item->name."</td>";
        $html .= "  <td><a class='btn btn-primary' href='updateproducttype.php?id=".$item->id."'>Update</a></td>";
        $html .= "  <td><button class='btn btn-danger btndelete'>Delete <span hidden>".$item->id."</span></button></td>";
        $html .= "</tr>";
      }

      $filename = 0;

      echo $html;
    }
    else
    {
      echo "no data";
    }
  }
  else if($_GET['itemtype'] == "productpic")
  {
    $items = ProductPic::get_all();

    if(count($items) > 0)
    {
      foreach ($items as $item) 
      {
        $filename++;

        $random = rand(0, 1);

        file_put_contents("images/".$filename."x".$random.".jpg", base64_decode($item->picture));

        $item->picture = HOST."includes/webservices/images/".$filename."x".$random.".jpg";

        $html .= "<tr>";
        $html .= "  <td>productid ".$item->productid."</td>";
        $html .= "  <td><img src='".$item->picture."' height='40' width='40'/></td>";
        $html .= "  <td><a class='btn btn-primary' href='updateproductpic.php?id=".$item->id."'>Update</a></td>";
        $html .= "  <td><button class='btn btn-danger btndelete'>Delete <span hidden>".$item->id."</span></button></td>";
        $html .= "</tr>";
      }

      $filename = 0;

      echo $html;
    }
    else
    {
      echo "no data";
    }
  }
  else if($_GET['itemtype'] == "traffic")
  {
    $items = Traffic::search($input);

    if(count($items) > 0)
    {
      foreach ($items as $item) 
      {
        $filename++;

        $random = rand(0, 1);

        file_put_contents("images/".$filename."x".$random.".jpg", base64_decode($item->picture));

        $item->picture = HOST."includes/webservices/images/".$filename."x".$random.".jpg";

        $html .= "<tr>";
        $html .= "  <td><img src='".$item->picture."' height='40' width='40'/></td>";
        $html .= "  <td>userid ".$item->userid."</td>";
        $html .= "  <td>storeid ".$item->storeid."</td>";
        $html .= "  <td>status ".$item->status."</td>";
        $html .= "  <td>".$item->comment."</td>";
        $html .= "  <td><a class='btn btn-primary' href='updatetraffic.php?id=".$item->id."'>Update</a></td>";
        $html .= "  <td><button class='btn btn-danger btndelete'>Delete <span hidden>".$item->id."</span></button></td>";
        $html .= "</tr>";
      }

      $filename = 0;

      echo $html;
    }
    else
    {
      echo "no data";
    }
  }
  else if($_GET['itemtype'] == "review")
  {
    $items = Review::search($input);

    if(count($items) > 0)
    {
      foreach ($items as $item) 
      {
        $html .= "<tr>";
        $html .= "  <td>userid ".$item->userid."</td>";
        $html .= "  <td>rating ".$item->rating."</td>";
        $html .= "  <td>".$item->review."</td>";
        $html .= "  <td><a class='btn btn-primary' href='updatereview.php?id=".$item->id."'>Update</a></td>";
        $html .= "  <td><button class='btn btn-danger btndelete'>Delete <span hidden>".$item->id."</span></button></td>";
        $html .= "</tr>";
      }

      echo $html;
    }
    else
    {
      echo "no data";
    }
  }
  else if($_GET['itemtype'] == "featureditem")
  {
    $items = FeaturedItem::get_all();

    if(count($items) > 0)
    {
      foreach ($items as $item) 
      {
        $theitem = new Product();
        $thedesc = "";
        $thepicture = "";

        if($item->itemtype == "store")
        {
          $theitem = Store::get_by_id($item->itemid);
          $thedesc = $theitem->branchname;
        }
        else if($item->itemtype == "product")
        {
          $theitem = Product::get_by_id($item->itemid);
          $thedesc = $theitem->description;
        }

        if($item->override == 1)
        {
          $thepicture = $item->picture;
        }
        else
        {
          $thepicture = $theitem->picture;
        }

        $filename++;

        $random = rand(0, 1);

        file_put_contents("images/".$filename."x".$random.".jpg", base64_decode($thepicture));

        $thepicture = HOST."images/".$filename."x".$random.".jpg";

        $html .= "<tr>";
        $html .= "  <td><img src='data:image/jpeg;base64, ".$thepicture."' style='height:25px;' /></td>";
        $html .= "  <td>type: ".$item->itemtype."</td>";
        $html .= "  <td>override: ".($item->override == 1 ? "Yes" : "No" )."</td>";
        $html .= "  <td>".$theitem->name."</td>";
        $html .= "  <td>".$thedesc."</td>";
        $html .= "  <td><a class='btn btn-primary' href='updatefeatureditem.php?id=".$item->id."'>Update</a></td>";
        $html .= "  <td><button class='btn btn-danger btndelete'>Delete <span hidden>".$item->id."</span></button></td>";
        $html .= "</tr>";
      }

      $filename = 0;

      echo $html;
    }
    else
    {
      echo "no data";
    }
  }
  else if($_GET['itemtype'] == "itempic")
  {
    $items = ItemPic::get_all();

    if(count($items) > 0)
    {
      foreach ($items as $item) 
      {
        $filename++;

        $random = rand(0, 1);

        file_put_contents("images/".$filename."x".$random.".jpg", base64_decode($item->picture));

        $item->picture = HOST."includes/webservices/images/".$filename."x".$random.".jpg";

        $html .= "<tr>";
        $html .= "  <td>type ".$item->itemtype."</td>";
        $html .= "  <td><img src='".$item->picture."' height='40' width='40'/></td>";
        $html .= "  <td><a class='btn btn-primary' href='updateitempic.php?id=".$item->id."'>Update</a></td>";
        $html .= "  <td><button class='btn btn-danger btndelete'>Delete <span hidden>".$item->id."</span></button></td>";
        $html .= "</tr>";
      }

      $filename = 0;

      echo $html;
    }
    else
    {
      echo "no data";
    }
  }
  else
  {
    echo "unknown itemtype";
  }
}
else
{
  echo "no itemtype";
}

?>