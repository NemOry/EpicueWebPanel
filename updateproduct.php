<?php 

require_once("header.php"); 

if(isset($_GET['id']))
{
  $object = Product::get_by_id($_GET['id']);
}
else
{
  header("location: index.php?negative");
}

if(!$session->is_logged_in())
{
  header("location: index.php?negative");
}
else
{
  $loggeduser = User::get_by_id($session->userid);

  if($loggeduser->enabled == DISABLED)
  {
    header("location: index.php?disabled");
  }
}

$pathinfo = pathinfo($_SERVER["PHP_SELF"]);
$basename = $pathinfo["basename"];
$currentFile = str_replace(".php","", $basename);

?>

<div class="container-fluid">
<div class="row-fluid">
  <div class="span1"></div>
  <div class="span9">
    <form id="theform" class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
      <fieldset>
      <legend>
        Update
      </legend>

      <div class="control-group">
          <label class="control-label" for="moto">Photo</label>
          <div class="controls">
            <div class="fileupload fileupload-new" data-provides="fileupload">
              <div class="fileupload-new thumbnail" style="height: 200px;"><img src='data:image/jpeg;base64, <?php echo $object->picture; ?>' /></div>
              <div class="fileupload-preview fileupload-exists thumbnail" style="max-height: 200px; line-height: 20px;"></div>
              <div>
                <span class="btn btn-file">
                  <span class="fileupload-new">Select image</span>
                  <span class="fileupload-exists">Change</span>
                  <input name="MAX_FILE_SIZE" hidden value="2097152" />
                  <input name="picture" type="file" />
                </span>
                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                <a class="mytooltip" data-toggle="tooltip" data-placement="right" 
                  title=
                  "
                    OPTIONAL: extensions allowed: JPEG/JPG and PNG
                    , Up to 2MB, Recommended size: 200x200
                  ">
                  <span class="label label">?</span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="name">* Name</label>
          <div class="controls">
            <input value="<?php echo $object->name; ?>" id="name" name="name" type="text" placeholder="name" class="input-xlarge">
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="description">Description</label>
          <div class="controls">
            <textarea id="description" name="description" class="span8"  placeholder="description" style="width:285px; height:100px"><?php echo $object->description; ?></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="price">* Price</label>
          <div class="controls">
            <input value="<?php echo $object->price; ?>" id="price" name="price" type="text" placeholder="price" class="input-xlarge">
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="name">* Product Type</label>
          <div class="controls">
            <select name="producttypeid" id="producttypeid">
              <?php

              $producttypes = ProductType::get_all();

              if(count($producttypes) > 0)
              {
                foreach ($producttypes as $producttype) 
                {
                  echo "<option ".($object->producttypeid == $producttype->id ? "selected" : "")." value='".$producttype->id."'>".$producttype->name."</option>";
                }
              }
              else
              {
                echo "<option value='0'>no product types yet</option>";
              }

              ?>
            </select>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="name">* Store</label>
          <div class="controls">
            <select name="storeid" id="storeid">
              <?php

              $items = Store::get_all();

              if(count($items) > 0)
              {
                foreach ($items as $item) 
                {
                  echo "<option ".($object->storeid == $item->id ? "selected" : "")." value='".$item->id."'>".$item->name."</option>";
                }
              }
              else
              {
                echo "<option value='0'>no stores yet</option>";
              }

              ?>
            </select>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="pending">Status</label>
          <div class="controls">
            <input type="hidden" name="pending" value="<?php echo $object->pending; ?>" id="btn-input2" />
            <div class="btn-group" data-toggle="buttons-radio">
              <button type="button" value="0" id="btn-enabled2" class="btn active">Approved</button>
              <button type="button" value="1" id="btn-disabled2" class="btn">Pending</button>
            </div>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="enabled">Access</label>
          <div class="controls">
            <input type="hidden" name="enabled" value="<?php echo $object->enabled; ?>" id="btn-input3" />
            <div class="btn-group" data-toggle="buttons-radio">
              <button type="button" value="1" id="btn-enabled3" class="btn active">Enabled</button>
              <button type="button" value="0" id="btn-disabled3" class="btn">Disabled</button>
            </div>
          </div>
        </div>

      <input type="hidden" name="productid" value="<?php echo $object->id; ?>" />

      <!-- Button -->
      <div class="control-group">
        <label class="control-label" for="updatesubmit"></label>
        <div class="controls">
          <button id="btnsave" name="btncreate" class="btn btn-primary">Save</button>
        </div>
      </div>

      </fieldset>
      </form>
  </div>
</div><!--/row-->
<script>

$(function () 
{

  $("#btnsave").click(function()
  {
    var formData = new FormData($("#theform")[0]);

    $("#btnsave").text("Saving...");
    $("#btnsave").attr("disabled", "disabled");

    $.ajax(
    {
      type: 'POST',
      url: 'includes/webservices/updateproduct.php',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      xhr: function() 
      {
          var myXhr = $.ajaxSettings.xhr();

          if(myXhr.upload)
          {
              myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
          }
          return myXhr;
      },
      success: function(result) 
      {
        if(result == "success")
        {
          showToast("Successfully Saved", "success");
          $("#btnsave").text("Save");
          $("#btnsave").removeAttr("disabled");
        }
        else
        {
          bootbox.alert(result);
          $("#btnsave").text("Save");
          $("#btnsave").removeAttr("disabled");
        }
      }
    });

    return false;
  });

  $(':file').change(function()
  {
      var file = this.files[0];
      name = file.name;
      size = file.size;
      type = file.type;
  });

  function progressHandlingFunction(e)
  {
    if(e.lengthComputable)
    {
      // $('.progress').attr({value:e.loaded,max:e.total});
      console.log("max: "+e.total+", progress: " + e.loaded);
    }
  }

  var btns2 = ['btn-enabled2', 'btn-disabled2'];
    var input2 = document.getElementById('btn-input2');

    for(var i = 0; i < btns2.length; i++) 
    {
      document.getElementById(btns2[i]).addEventListener('click', function() 
      {
        input2.value = this.value;
      });
    }

    var btns3 = ['btn-enabled3', 'btn-disabled3'];
    var input3 = document.getElementById('btn-input3');

    for(var i = 0; i < btns3.length; i++) 
    {
      document.getElementById(btns3[i]).addEventListener('click', function() 
      {
        input3.value = this.value;
      });
    }

});

</script>
      
<?php require_once("footer.php"); ?>