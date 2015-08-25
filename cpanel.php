<?php 

require_once("header.php"); 

$pathinfo = pathinfo($_SERVER["PHP_SELF"]);
$basename = $pathinfo["basename"];
$currentFile = str_replace(".php","", $basename);

if($session->is_logged_in())
{
  $user = User::get_by_id($session->userid);

  if($user->enabled == DISABLED)
  {
    header("location: index.php");
  }
}
else
{
  header("location: index.php");
}

?>

<div class="container-fluid">
  <div class="row-fluid">
    <ul class="nav nav-tabs">
      <li class="active"><a id="userstab" href="#users" data-toggle="tab">Users</a></li>
      <li><a id="storestab" href="#stores" data-toggle="tab">Stores</a></li>
      <!-- <li><a id="storetypestab" href="#storetypes" data-toggle="tab">Store Types</a></li>
      <li><a id="storepicstab" href="#storepics" data-toggle="tab">Store Pics</a></li> -->
      <li><a id="productstab" href="#products" data-toggle="tab">Products</a></li>
     <!--  <li><a id="producttypestab" href="#producttypes" data-toggle="tab">Product Types</a></li>
      <li><a id="productpicstab" href="#productpics" data-toggle="tab">Product Pics</a></li> -->
      <li><a id="reviewstab" href="#reviews" data-toggle="tab">Reviews</a></li>
      <li><a id="trafficstab" href="#traffics" data-toggle="tab">Traffics</a></li>
      <li><a id="logstab" href="#logs" data-toggle="tab">Logs</a></li>
    </ul>
    
    <div class="tab-content">
      <div class="tab-pane active" id="users"><?php require_once("public/grids/users.php"); ?></div>
      <div class="tab-pane" id="stores"><?php require_once("public/grids/stores.php"); ?></div>
      <!-- <div class="tab-pane" id="storetypes"><?php //require_once("public/grids/storetypes.php"); ?></div>
      <div class="tab-pane" id="storepics"><?php //require_once("public/grids/storepics.php"); ?></div> -->
      <div class="tab-pane" id="products"><?php require_once("public/grids/products.php"); ?></div>
     <!--  <div class="tab-pane" id="producttypes"><?php //require_once("public/grids/producttypes.php"); ?></div>
      <div class="tab-pane" id="productpics"><?php //require_once("public/grids/productpics.php"); ?></div> -->
      <div class="tab-pane" id="reviews"><?php require_once("public/grids/reviews.php"); ?></div>
      <div class="tab-pane" id="traffics"><?php require_once("public/grids/traffics.php"); ?></div>
      <div class="tab-pane" id="logs"><?php require_once("public/grids/logs.php"); ?></div>
    </div>

  </div><!--/row-->

  <script>

    $("#userstab").click(function()
    {
      $("#grid_users").trigger("reloadGrid");
    });

    $("#storestab").click(function()
    {
      $("#grid_stores").trigger("reloadGrid");
    });

    $("#storetypestab").click(function()
    {
      $("#grid_storetypes").trigger("reloadGrid");
    });

    $("#storepicstab").click(function()
    {
      $("#grid_storepics").trigger("reloadGrid");
    });

    $("#productstab").click(function()
    {
      $("#grid_products").trigger("reloadGrid");
    });

    $("#producttypestab").click(function()
    {
      $("#grid_producttypes").trigger("reloadGrid");
    });

    $("#productpicstab").click(function()
    {
      $("#grid_productpics").trigger("reloadGrid");
    });

    $("#trafficstab").click(function()
    {
      $("#grid_traffics").trigger("reloadGrid");
    });

    $("#reviewstab").click(function()
    {
      $("#grid_reviews").trigger("reloadGrid");
    });

    $("#logstab").click(function()
    {
      $("#grid_logs").trigger("reloadGrid");
    });

  </script>
  
<?php require_once("footer.php"); ?>