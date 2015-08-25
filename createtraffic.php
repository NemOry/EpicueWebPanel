<?php 

require_once("header.php"); 

if(!$session->is_logged_in())
{
  header("location: index.php");
}
else
{
  $user = User::get_by_id($session->userid);

  if($user->enabled == DISABLED)
  {
    header("location: index.php");
  }
}

$pathinfo = pathinfo($_SERVER["PHP_SELF"]);
$basename = $pathinfo["basename"];
$currentFile = str_replace(".php","", $basename);

?>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span5">
      <form id="theform" class="form-horizontal" method="post" action="#" enctype="multipart/form-data">
        <fieldset>
        <legend>
          Create Traffic
        </legend>

        <div class="control-group">
          <label class="control-label" for="moto">Photo</label>
          <div class="controls">
            <div class="fileupload fileupload-new" data-provides="fileupload">
              <div class="fileupload-new thumbnail" style="height: 200px;"><img src="public/img/thumbnail.png" /></div>
              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 200px; line-height: 20px;"></div>
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
          <label class="control-label" for="name">* User</label>
          <div class="controls">
            <select name="userid" id="userid">
              <?php

              $items = User::get_all();

              if(count($items) > 0)
              {
                foreach ($items as $item) 
                {
                  echo "<option value='".$item->id."'>".$item->get_full_name()."</option>";
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
          <label class="control-label" for="name">* Store</label>
          <div class="controls">
            <select name="storeid" id="storeid">
              <?php

              $items = Store::get_all();

              if(count($items) > 0)
              {
                foreach ($items as $item) 
                {
                  echo "<option value='".$item->id."'>".$item->name."</option>";
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
          <label class="control-label" for="status">* Status / Rating</label>
          <div class="controls">
            <select name="status" id="status">
              <option value='1'>1 Very Bad</option>
              <option value='2'>2 Bad</option>
              <option value='3'>3 Good</option>
              <option value='4'>4 Above Average</option>
              <option value='5'>5 Excellent</option>
            </select>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="comment">* Comment</label>
          <div class="controls">
            <textarea id="comment" name="comment" class="span8"  placeholder="comment" style="width:285px; height:100px"></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="longitude"> Longitude</label>
          <div class="controls">
            <textarea id="longitude" name="longitude" class="span8"  placeholder="longitude" style="width:285px; height:100px"></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="latitude"> Latitude</label>
          <div class="controls">
            <textarea id="latitude" name="latitude" class="span8"  placeholder="latitude" style="width:285px; height:100px"></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="pending">Status</label>
          <div class="controls">
            <input type="hidden" name="pending" value="0" id="btn-input2" />
            <div class="btn-group" data-toggle="buttons-radio">
              <button type="button" value="0" id="btn-enabled2" class="btn active">Approved</button>
              <button type="button" value="1" id="btn-disabled2" class="btn">Pending</button>
            </div>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="enabled">Access</label>
          <div class="controls">
            <input type="hidden" name="enabled" value="1" id="btn-input3" />
            <div class="btn-group" data-toggle="buttons-radio">
              <button type="button" value="1" id="btn-enabled3" class="btn active">Enabled</button>
              <button type="button" value="0" id="btn-disabled3" class="btn">Disabled</button>
            </div>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="btncreate"></label>
          <div class="controls">
            <button id="btncreate" name="btncreate" class="btn btn-primary">Create</button>
          </div>
        </div>
        </fieldset>
      </form>
    </div>
    <br /><br /><br /><br />
    <div class="span6 well" style="max-height:600px; height:600px; overflow:scroll;">
      <legend>
          Traffics <button onclick="loadtable(); return false;" class="btn btn-mini btn-success"><i class="icon-large icon-refresh icon-white"></i></button> <span id="loading" class="label">Loading...</span>
      </legend>
      <div class="input-prepend">
        <span class="add-on">Search</span>
        <input class="span12" id="tablesearch" type="text" placeholder="search">
      </div>
      <table id="table" class="table table-bordered">
        
      </table>
    </div>
  </div><!--/row-->
  <script>

  $("#tablesearch").keyup(function()
  {
    loadtable();
  });

  var loading = $("#loading");

  function loadtable()
  {
    
    loading.removeClass("hide");

    $.ajax(
    {
      url: 'includes/webservices/gettable.php?itemtype=traffic&input='+$("#tablesearch").val(),
      success: function(result) 
      {
        $("#table").html(result);

        loading.addClass("hide");
      }
    });
  }

  loadtable();

  $(document).on("click", ".btndelete", function()
  {
    var id = $(this).find("span").text();

    $(this).text("Processing..");
    $(this).attr("disabled", "disabled");

    $.ajax(
    {
      type: 'get',
      url: 'includes/webservices/delete.php?itemid='+id+'&itemtype=traffic',
      success: function(result) 
      {
        loadtable();
      }
    });
  });

  $(function () 
  { 

    $("#btncreate").click(function()
    {
      var formData = new FormData($("#theform")[0]);

      $("#btncreate").text("Processing");
      $("#btncreate").attr("disabled", "disabled");

      $.ajax(
      {
        type: 'POST',
        url: 'includes/webservices/createtraffic.php',
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
            showToast("Successfully Created", "success");
            $("#btncreate").text("Create");
            $("#btncreate").removeAttr("disabled");
            $('#theform')[0].reset();
            loadtable();
          }
          else
          {
            bootbox.alert(result);
            $("#btncreate").text("Create");
            $("#btncreate").removeAttr("disabled");
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
        console.log("progress: " + e.loaded);
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