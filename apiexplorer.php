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

    <div class="container-fixed">
      <div class="row-fixed">

        <div class="span2">
          <div class="well">
            <div class="btn-group">
              <a class="btn btn-small btn-info dropdown-toggle" data-toggle="dropdown" href="#">
                View Table Fields
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" name="tables">
                <li id="liusers"><a>Users</a></li>
                <li id="listores"><a>Stores</a></li>
                <li id="listoretypes"><a>Store Types</a></li>
                <li id="listorepics"><a>Store Pics</a></li>
                <li id="liproducts"><a>Products</a></li>
                <li id="liproducttypes"><a>Product Types</a></li>
                <li id="liproductpics"><a>Product Pics</a></li>
                <li id="lireviews"><a>Reviews</a></li>
                <li id="litraffics"><a>Traffics</a></li>
                <li id="lifeatureditems"><a>Featured Items</a></li>
                <li id="liitempics"><a>Item Pics</a></li>
              </ul>
            </div>
            <span class="nav-header">Table Fields</span>
            <ol id="fieldusers" class="nav nav-list pagesol">
              <li><a>id (int)</a></li>
              <li><a>username (string) *</a></li>
              <li><a>password (string) *</a></li>
              <li><a>email (string)</a></li>
              <li><a>firstname (string) *</a></li>
              <li><a>middlename (string)</a></li>
              <li><a>lastname (string) *</a></li>
              <li><a>birthdate (date)</a></li>
              <li><a>gender (int)</a></li>
              <li><a>picture (blob)</a></li>
              <li><a>twitterid (int)</a></li>
              <li><a>facebookid (int)</a></li>
              <li><a>foursquareid (int)</a></li>
              <li><a>scoreloopid (int)</a></li>
              <li><a>pending (int)</a></li>
              <li><a>enabled (int)</a></li>
              <li><a>datetime (datetime)</a></li>
            </ol>
            <ol id="fieldstores" class="nav nav-list pagesol">
              <li><a>id (int)</a></li>
              <li><a>name (string) *</a></li>
              <li><a>branchname (string)</a></li>
              <li><a>address (string) *</a></li>
              <li><a>longitude (string)</a></li>
              <li><a>latitude (string)</a></li>
              <li><a>picture (blob)</a></li>
              <li><a>telnum (string)</a></li>
              <li><a>deliverynum (string)</a></li>
              <li><a>email (date)</a></li>
              <li><a>storetypeid (int)</a></li>
              <li><a>pending (int)</a></li>
              <li><a>enabled (int)</a></li>
              <li><a>datetime (datetime)</a></li>
            </ol>
            <ol id="fieldstoretypes" class="nav nav-list pagesol">
              <li><a>id (int)</a></li>
              <li><a>name (string) *</a></li>
              <li><a>description (string)</a></li>
              <li><a>picture (blob)</a></li>
              <li><a>pending (int)</a></li>
              <li><a>enabled (int)</a></li>
              <li><a>datetime (datetime)</a></li>
            </ol>
            <ol id="fieldproducts" class="nav nav-list pagesol">
              <li><a>id (int)</a></li>
              <li><a>storeid (int) *</a></li>
              <li><a>name (string) *</a></li>
              <li><a>description (string)</a></li>
              <li><a>price (double) *</a></li>
              <li><a>producttypeid (int) *</a></li>
              <li><a>picture (blob)</a></li>
              <li><a>pending (int)</a></li>
              <li><a>enabled (int)</a></li>
              <li><a>datetime (datetime)</a></li>
            </ol>
            <ol id="fieldproducttypes" class="nav nav-list pagesol">
              <li><a>id (int)</a></li>
              <li><a>name (string) *</a></li>
              <li><a>description (string)</a></li>
              <li><a>picture (blob)</a></li>
              <li><a>pending (int)</a></li>
              <li><a>enabled (int)</a></li>
              <li><a>datetime (datetime)</a></li>
            </ol>
            <ol id="fieldreviews" class="nav nav-list pagesol">
              <li><a>id (int)</a></li>
              <li><a>userid (int) *</a></li>
              <li><a>itemid (int) *</a></li>
              <li><a>itemtype (string) *</a></li>
              <li><a>review (string) *</a></li>
              <li><a>rating (int) *</a></li>
              <li><a>picture (blob)</a></li>
              <li><a>pending (int)</a></li>
              <li><a>enabled (int)</a></li>
              <li><a>datetime (datetime)</a></li>
            </ol>
            <ol id="fieldtraffics" class="nav nav-list pagesol">
              <li><a>id (int)</a></li>
              <li><a>userid (int) *</a></li>
              <li><a>storeid (int) *</a></li>
              <li><a>status (int) *</a></li>
              <li><a>comment (string) *</a></li>
              <li><a>longitude (string)</a></li>
              <li><a>latitude (string)</a></li>
              <li><a>picture (blob)</a></li>
              <li><a>pending (int)</a></li>
              <li><a>enabled (int)</a></li>
              <li><a>datetime (datetime)</a></li>
            </ol>
            <ol id="fieldfeatureditems" class="nav nav-list pagesol">
              <li><a>id (int)</a></li>
              <li><a>itemid (int) *</a></li>
              <li><a>itemtype (string) *</a></li>
              <li><a>picture (blob)</a></li>
              <li><a>override (int)</a></li>
              <li><a>pending (int)</a></li>
              <li><a>enabled (int)</a></li>
              <li><a>datetime (datetime)</a></li>
            </ol>
            <ol id="fielditempics" class="nav nav-list pagesol">
              <li><a>id (int)</a></li>
              <li><a>itemid (int) *</a></li>
              <li><a>itemtype (string) *</a></li>
              <li><a>picture (blob)</a></li>
              <li><a>pending (int)</a></li>
              <li><a>enabled (int)</a></li>
              <li><a>datetime (datetime)</a></li>
            </ol>
          </div>
        </div>

        <div class="span10">

          <div class="well">
            <div class="input-prepend">
              <span class="add-on"><?php echo HOSTNAME; ?>includes/webservices/</span>
              <input class="span11 url" type="text" value="getusers.php?firstname=Oliv&sortby=id&sortorder=desc&limit=2">
              <button class="btn btn-info btngetjson" type="button">Get JSON</button>
            </div>
            <!-- <textarea class="span12"  style="height:130px;"></textarea> -->
            <div id="json" style="height:130px; overflow:scroll;">
              
            </div>
          </div>

          <div class="well" id="files">
            <div class="accordion" id="accordion2">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse1">
                    HTTP GET URLS
                  </a>
                </div>
                <div id="collapse1" class="accordion-body collapse in">
                  <div class="accordion-inner">
                    <table class="table table-bordered">
                      <tr>
                        <td>getusers.php</td>
                        <td>getstores.php</td>
                        <td>getstoretypes.php</td>
                        <td>getproducts.php</td>
                      </tr>
                      <tr>
                        <td>getproducttypes.php</td>
                        <td>getreviews.php</td>
                        <td>gettraffics.php</td>
                        <td>getitempics.php</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>getfeatureditems.php</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>
                    <table class="table table-bordered">
                      <caption class="text-left"><b>PARAMETERS</b></caption>
                      <tr>
                        <td>&blob (will give blob data, if blank: direct image url)</td>
                        <td>&limit = 1 (default 1000)</td>
                        <td>&sortby = field (id, username etc..)</td>
                        <td>&sortorder = asc / desc (default asc)</td>
                        <td>&equal (will use = instead of LIKE, only for string fields)</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2">
                    HTTP POST CREATE URLS
                  </a>
                </div>
                <div id="collapse2" class="accordion-body collapse">
                  <div class="accordion-inner">
                    <table class="table table-bordered">
                      <tr>
                        <td>createuser.php</td>
                        <td>createstore.php</td>
                        <td>createstoretype.php</td>
                        <td>createproduct.php</td>
                      </tr>
                      <tr>
                        <td>createproducttype.php</td>
                        <td>createreview.php</td>
                        <td>createtraffic.php</td>
                        <td>createitempic</td>
                      </tr>
                      <tr>
                        <td>createfeatureditem.php</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse3">
                    HTTP POST UPDATE URLS
                  </a>
                </div>
                <div id="collapse3" class="accordion-body collapse">
                  <div class="accordion-inner">
                    <table class="table table-bordered">
                      <tr>
                        <td>updateuser.php</td>
                        <td>updatestore.php</td>
                        <td>updatestoretype.php</td>
                        <td>updateproduct.php</td>
                      </tr>
                      <tr>
                        <td>updateproducttype.php</td>
                        <td>updatereview.php</td>
                        <td>updatetraffic.php</td>
                        <td>updateitempic</td>
                      </tr>
                      <tr>
                        <td>updatefeatureditem.php</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse4">
                    HTTP GET DELETE URLS
                  </a>
                </div>
                <div id="collapse4" class="accordion-body collapse">
                  <div class="accordion-inner">
                    <table class="table table-bordered">
                      <tr>
                        <td>delete.php</td>
                        <td>GET PARAMETERS: itemid (required) and itemtype (required)</td>
                        <td>item ids (int): specific ids of: userid, storeid, storetypeid, storepicid, productid, producttypeid, productpicid, trafficid, reviewid</td>
                        <td>item types (string): user, store, storetype, storepic, product, producttype, productpic, traffic, review</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse5">
                    BLACKBERRY PUSH SERVICE DETAILS
                  </a>
                </div>
                <div id="collapse5" class="accordion-body collapse">
                  <div class="accordion-inner">
                    <table class="table table-bordered">
                      <tr>
                        <td>APP ID</td>
                        <td>4170-5aa092r1ee29405f98r0oM4c08087126s06</td>
                      </tr>
                      <tr>
                        <td>PASSWORD</td>
                        <td>QU8was3NB</td>
                      </tr>
                      <tr>
                        <td>PPG URL</td>
                        <td>http://cp4170-5aa092r1ee29405f98r0oM4c08087126s06.pushapi.eval.blackberry.com</td>
                      </tr>
                      <tr>
                        <td>BlackBerry Push Documentation</td>
                        <td><a href="https://developer.blackberry.com/devzone/develop/platform_services/push_overview.html">https://developer.blackberry.com/devzone/develop/platform_services/push_overview.html</a></td>
                      </tr>
                      <tr>
                        <td>Sample Cascades App</td>
                        <td><a href="https://github.com/blackberry/Cascades-Samples/tree/master/pushCollector">https://github.com/blackberry/Cascades-Samples/tree/master/pushCollector</a></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>

  </div><!--/row-->

  <script>

  $(document).ready(function()
  {

    var btn = $(".btngetjson");

    function myGetJSON()
    {
      btn.text("Processing..");
      btn.attr("disabled", "disabled");

      $.getJSON("includes/webservices/"+$(".url").val(), function(data) 
      {
        $("#json").html(JSON.stringify(data));

        btn.text("Get JSON");
        btn.removeAttr("disabled");

      }).fail(function() 
      {
        $("#json").html("INVALID REQUEST");

        btn.text("Get JSON");
        btn.removeAttr("disabled");
      });
    }

    myGetJSON();

    $(".btngetjson").click(function()
    {
      myGetJSON();
    });

    $("#liusers").click(function()
    {
      hideFields();
      $("#fieldusers").removeClass("hide");
    });

    $("#listores").click(function()
    {
      hideFields();
      $("#fieldstores").removeClass("hide");
    });

    $("#listoretypes").click(function()
    {
      hideFields();
      $("#fieldstoretypes").removeClass("hide");
    });

    $("#liproducts").click(function()
    {
      hideFields();
      $("#fieldproducts").removeClass("hide");
    });

    $("#liproducttypes").click(function()
    {
      hideFields();
      $("#fieldproducttypes").removeClass("hide");
    });

    $("#lireviews").click(function()
    {
      hideFields();
      $("#fieldreviews").removeClass("hide");
    });

    $("#litraffics").click(function()
    {
      hideFields();
      $("#fieldtraffics").removeClass("hide");
    });

    $("#liitempics").click(function()
    {
      hideFields();
      $("#fielditempics").removeClass("hide");
    });

    $("#lifeatureditems").click(function()
    {
      hideFields();
      $("#fieldfeatureditems").removeClass("hide");
    });

    function hideFields()
    {
      $("#fieldusers").addClass("hide");
      $("#fieldstores").addClass("hide");
      $("#fieldstoretypes").addClass("hide");
      $("#fieldproducts").addClass("hide");
      $("#fieldproducttypes").addClass("hide");
      $("#fieldreviews").addClass("hide");
      $("#fieldtraffics").addClass("hide");
      $("#fielditempics").addClass("hide");
      $("#fieldfeatureditems").addClass("hide");
    }

    hideFields();

    $("#fieldusers").removeClass("hide");

  });

  </script>
  
<?php require_once("footer.php"); ?>