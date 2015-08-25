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

?>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span5">
      <form id="theform" class="form-horizontal" method="post" action="#" enctype="multipart/form-data">
        <fieldset>
        <legend>
          Send Push Message
        </legend>

        <div class="control-group">
          <label class="control-label" for="message">Message</label>
          <div class="controls">
            <textarea id="message" name="message" class="span8"  placeholder="message" style="width:285px; height:100px"></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="btnsend"></label>
          <div class="controls">
            <button id="btnsend" name="btnsend" class="btn btn-primary">Send</button>
          </div>
        </div>
        </fieldset>
      </form>
    </div>
    
  </div><!--/row-->
  <script>

  $(function () 
  {
    
    $("#btnsend").click(function()
    {
      $("#btnsend").text("Sending...");
      $("#btnsend").attr("disabled", "disabled");

      var formData = new FormData($("#theform")[0]);

      $.ajax(
      {
        type: 'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        url: 'includes/webservices/push.php',
        success: function(result) 
        {
          $("#btnsend").text("Send");
          $("#btnsend").removeAttr("disabled");

          bootbox.alert(result);
        }
      });

    });

  });


  </script>

<?php require_once("footer.php"); ?>