<?php 

require_once("header.php"); 

if(isset($_GET['id']))
{
  $object = Review::get_by_id($_GET['id']);
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
          <label class="control-label" for="name">* User</label>
          <div class="controls">
            <select name="userid" id="userid">
              <?php

              $items = User::get_all();

              if(count($items) > 0)
              {
                foreach ($items as $item) 
                {
                  echo "<option ".($object->userid == $item->id ? "selected" : "")." value='".$item->id."'>".$item->get_full_name()."</option>";
                }
              }
              else
              {
                echo "<option value='0'>no users yet</option>";
              }

              ?>
            </select>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="name">* Item Type</label>
          <div class="controls">
            <select name="itemtype" id="itemtype">
              <option value='store'>Store</option>
              <option value='product'>Product</option>
            </select>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="itemid">* Item</label>
          <div class="controls">
            <select name="itemid" id="itemid">

            </select>
            <span id="loadingindicator" class="label hide">Loading...</span>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="review">* Review</label>
          <div class="controls">
            <textarea id="review" name="review" class="span8"  placeholder="review" style="width:285px; height:100px"><?php echo $object->review; ?></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="rating">* Rating</label>
          <div class="controls">
            <select name="rating" id="rating">
              <option value='1' <?php echo ($object->rating == 1 ? "selected" : ""); ?> >1 Very Bad</option>
              <option value='2' <?php echo ($object->rating == 2 ? "selected" : ""); ?> >2 Bad</option>
              <option value='3' <?php echo ($object->rating == 3 ? "selected" : ""); ?> >3 Good</option>
              <option value='4' <?php echo ($object->rating == 4 ? "selected" : ""); ?> >4 Above Average</option>
              <option value='5' <?php echo ($object->rating == 5 ? "selected" : ""); ?> >5 Excellent</option>
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

      <input type="hidden" name="reviewid" value="<?php echo $object->id; ?>" />

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
      url: 'includes/webservices/updatereview.php',
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

    function loadItems()
  {
    $("#loadingindicator").removeClass("hide");

    var itemtype = $("#itemtype").val();

    $.ajax(
    {
      type: 'GET',
      url: 'includes/webservices/getitems.php?itemtype='+itemtype,
      success: function(result) 
      {
        $("#itemid").html(result);
        $("#loadingindicator").addClass("hide");
      }
    });
  }

  loadItems();

  $("#itemtype").click(function()
  {
    loadItems();
  });

});

</script>
      
<?php require_once("footer.php"); ?>