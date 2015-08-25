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

<style>
  
  .red
  {
    color: #E01B60;
  }

  .darkblue
  {
    color: #2876AD;
  }

  .violet
  {
    color: #80457F;
    font-style: normal;
  }

  .green
  {
    color: #008C5B;
  }

  .orange
  {
    color: #C48123;
  }

  .bold
  {
    font-style: bold;
  }

  .italic
  {
    font-style: italic;
  }

  .small
  {
    font-size: 10;
  }

  .medium
  {
    font-size: 10;
  }

  .big
  {
    font-size: 20px;
  }

</style>

<div class="container-fluid">
  <div class="row-fluid">

    <div class="container-fixed">
      <div class="row-fixed">

        <!-- <div class="span2">
          <div class="well">
            <span class="nav-header">Table Fields</span>
            
          </div>
        </div> -->

        <div class="span12">
          <div class="well">

            <h2>Epicue API Documentation & API Reference</h2>

            API Base URL:<br />
            Development <span class="btn-link"> http://epicue.kellyescape.com/includes/webservices/</span><br />
            Production <span class="btn-link"> http://epicue2.kellyescape.com/includes/webservices/</span>

            <br /><br />

            <div class="accordion-group">

              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse1">
                  HTTP GET SERVICES
                </a>
              </div>
              <div id="collapse1" class="accordion-body collapse">
                <div class="accordion-inner">

                  <p class="big">Extra HTTP GET Parameters</p>

                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>PARAMETER</th>
                        <th>TYPE</th>
                        <th>DEFAULT</th>
                        <th>DESCRIPTION</th>
                        <th>EXAMPLE</th>
                        <th>REQUIRED</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="darkblue">id</td>
                        <td class="violet">int</td>
                        <td class="green">(none)</td>
                        <td></td>
                        <td class="darkblue">getstores.php?id=1</td>
                        <td>no</td>
                      </tr>
                      <tr>
                        <td class="darkblue">sortby</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td></td>
                        <td class="darkblue">getproducts.php?sortby=id</td>
                        <td>no</td>
                      </tr>
                      <tr>
                        <td class="darkblue">sortorder</td>
                        <td class="violet">string</td>
                        <td class="green">ASC</td>
                        <td>ASC or DESC</td>
                        <td class="darkblue">getreviews.php?sortorder=DESC</td>
                        <td>no</td>
                      </tr>
                      <tr>
                        <td class="darkblue">equal</td>
                        <td class="violet">BLANK VALUE</td>
                        <td class="green">(none)</td>
                        <td>when present, LIKE is replaced with EQUAL in SQL</td>
                        <td class="darkblue">gettraffics.php?comment=Ewww&equal</td>
                        <td>no</td>
                      </tr>
                   </tbody>
                  </table>
                  
                  <h3>getstores.php</h3>
                  <i>Returns: Store (Object) JSON Array</i>
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse10">
                      JSON Returned Sample
                    </a>
                  </div>
                  <div id="collapse10" class="accordion-body collapse">
                    <div class="accordion-inner">
                      [{"id":"5","name":"Jollibee","branchname":"MCU Edsa","address":"EDSA cor. Morning Breeze, Caloocan","longitude":"120.988759","latitude":"14.657977","picture":"http://epicue.kellyescape.com/includes/webservices/images/1x0.jpg","telnum":"366-5463","deliverynum":"","email":"","storetypeid":"1","facebookid":"0","twitterid":"0","pending":"0","enabled":"1","datetime":"2013-09-13 14:41:13","distance":"0m","ratings":0,"trafficlevel":0,"trafficcount":0,"lasttrafficdatetime":"","averagestatus":true},{"id":"6","name":"Jollibee","branchname":"Mabini 10th Ave.","address":"Mabini cor. 10th Ave., Caloocan City","longitude":"120.989610","latitude":"14.651361","picture":"http://epicue.kellyescape.com/includes/webservices/images/2x1.jpg","telnum":"288-3146","deliverynum":"","email":"","storetypeid":"1","facebookid":"0","twitterid":"0","pending":"0","enabled":"1","datetime":"2013-09-13 14:41:17","distance":"0m","ratings":0,"trafficlevel":0,"trafficcount":0,"lasttrafficdatetime":"","averagestatus":true}]
                    </div>
                  </div>

                  <p>Used in (App): Home Screen Recommended Restaurants & in Search Page & Restaurant Page</p>
                  <p class="green">Example: <a href="#" class="thelink">http://epicue.kellyescape.com/includes/webservices/getstores.php?name=Joll&limit=2&sortby=branchname&sortorder=DESC</a></p>

                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>PARAMETER</th>
                        <th>TYPE</th>
                        <th>DEFAULT</th>
                        <th>DESCRIPTION</th>
                        <th>EXAMPLE</th>
                        <th>REQUIRED</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="darkblue">id</td>
                        <td class="violet">int</td>
                        <td class="green">(none)</td>
                        <td>Unique ID</td>
                        <td class="darkblue">?id=1</td>
                        <td>no</td>
                      </tr>
                      <tr>
                        <td class="darkblue">name</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td>Name</td>
                        <td class="darkblue">?name=Oliver</td>
                        <td>no</td>
                      </tr>
                      <tr>
                        <td class="darkblue">branchname</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td>Branch Name</td>
                        <td class="darkblue">?branchname=Jollibee</td>
                        <td>no</td>
                      </tr>
                      <tr>
                        <td class="darkblue">address</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td>Address</td>
                        <td class="darkblue">?address=Bacolod</td>
                        <td>no</td>
                      </tr>
                      <tr>
                        <td class="darkblue">longitude</td>
                        <td class="violet">double</td>
                        <td class="green">(none)</td>
                        <td>Location Longitude</td>
                        <td class="darkblue">?longitude=123.232323</td>
                        <td>no</td>
                      </tr>
                      <tr>
                        <td class="darkblue">latitude</td>
                        <td class="violet">double</td>
                        <td class="green">(none)</td>
                        <td>Location Latitude</td>
                        <td class="darkblue">?latitude=12.232323</td>
                        <td>no</td>
                      </tr>
                      <tr>
                        <td class="darkblue">telnum</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td>Telephone Number</td>
                        <td class="darkblue">?telnum=123233</td>
                        <td>no</td>
                      </tr>
                      <tr>
                        <td class="darkblue">email</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td>Email Address</td>
                        <td class="darkblue">?email=nemoryoliver@gmail.com</td>
                        <td>no</td>
                      </tr>
                      <tr>
                        <td class="darkblue">storetypeid</td>
                        <td class="violet">int</td>
                        <td class="green">(none)</td>
                        <td><i class="orange">StoreType</i> (Object) ID</td>
                        <td class="darkblue">?storetypeid=23</td>
                        <td>no</td>
                      </tr>
                      <tr>
                        <td class="darkblue">userlongitude</td>
                        <td class="violet">double</td>
                        <td class="green">(none)</td>
                        <td>The Longitude of User from App</td>
                        <td class="darkblue">?userlongitude=12.032321</td>
                        <td>no</td>
                      </tr>
                      <tr>
                        <td class="darkblue">userlatitude</td>
                        <td class="violet">double</td>
                        <td class="green">(none)</td>
                        <td>The Latitude of User from App</td>
                        <td class="darkblue">?userlatitude=111.032321</td>
                        <td>no</td>
                      </tr>
                      <tr>
                        <td class="darkblue">distance</td>
                        <td class="violet">int</td>
                        <td class="green">(none)</td>
                        <td>The maximum (km) distance from User to Restaurants</td>
                        <td class="darkblue">?distance=2</td>
                        <td>no</td>
                      </tr>
                    </tbody>
                  </table>

                </div>
              </div>

              <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapes2">
                  HTTP POST SERVICES
                </a>
              </div>
              <div id="collapes2" class="accordion-body collapse">
                <div class="accordion-inner">

                  <h3>createtraffic.php</h3>
                  <i>Returns: if success: "success" (string) else "(Error Message) (string)" </i>
                  <p>Used in (App): Posting a Cue</p>
                  <table class="table table-striped"> 
                    <thead>
                      <tr>
                        <th>PARAMETER</th>
                        <th>TYPE</th>
                        <th>DEFAULT</th>
                        <th>DESCRIPTION</th>
                        <th>EXAMPLE</th>
                        <th>REQUIRED</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="darkblue">userid</td>
                        <td class="violet">int</td>
                        <td class="green">(none)</td>
                        <td><i class="orange">User</i> (Object) ID</td>
                        <td class="darkblue">23</td>
                        <td>yes</td>
                      </tr>
                      <tr>
                        <td class="darkblue">storeid</td>
                        <td class="violet">int</td>
                        <td class="green">(none)</td>
                        <td><i class="orange">Store</i> (Object) ID</td>
                        <td class="darkblue">20</td>
                        <td>yes</td>
                      </tr>
                      <tr>
                        <td class="darkblue">status</td>
                        <td class="violet">int</td>
                        <td class="green">(none)</td>
                        <td>1 - 3</td>
                        <td class="darkblue">2</td>
                        <td>yes</td>
                      </tr>
                      <tr>
                        <td class="darkblue">comment</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td>Comment</td>
                        <td class="darkblue">The best restaurant in the Philippines</td>
                        <td>yes</td>
                      </tr>
                      <tr>
                        <td class="darkblue">longitude</td>
                        <td class="violet">double</td>
                        <td class="green">(none)</td>
                        <td>Longitude of User in App</td>
                        <td class="darkblue">12.0000</td>
                        <td>yes</td>
                      </tr>
                      <tr>
                        <td class="darkblue">latitude</td>
                        <td class="violet">double</td>
                        <td class="green">(none)</td>
                        <td>Latitude of User in App</td>
                        <td class="darkblue">123.232323</td>
                        <td>yes</td>
                      </tr>
                      <tr>
                        <td class="darkblue">picture</td>
                        <td class="violet">file</td>
                        <td class="green">(none)</td>
                        <td>Picture</td>
                        <td class="darkblue"></td>
                        <td>no</td>
                      </tr>
                    </tbody>
                  </table>

                  <h3>createreview.php</h3>
                  <i>Returns : if success: "success" (string) else "(Error Message) (string) " </i>
                  <p>Used in (App): Writing a Review</p>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>PARAMETER</th>
                        <th>TYPE</th>
                        <th>DEFAULT</th>
                        <th>DESCRIPTION</th>
                        <th>EXAMPLE</th>
                        <th>REQUIRED</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="darkblue">userid</td>
                        <td class="violet">int</td>
                        <td class="green">(none)</td>
                        <td><i class="orange">User</i> (Object) ID</td>
                        <td class="darkblue">53</td>
                        <td>yes</td>
                      </tr>
                      <tr>
                        <td class="darkblue">itemid</td>
                        <td class="violet">int</td>
                        <td class="green">(none)</td>
                        <td><i class="orange">Store (Object ID), Product (Object ID)</i></td>
                        <td class="darkblue">3</td>
                        <td>yes</td>
                      </tr>
                      <tr>
                        <td class="darkblue">itemtype</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td>store, product</td>
                        <td class="darkblue">store</td>
                        <td>yes</td>
                      </tr>
                      <tr>
                        <td class="darkblue">review</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td>Review</td>
                        <td class="darkblue">The best among the best</td>
                        <td>yes</td>
                      </tr>
                      <tr>
                        <td class="darkblue">rating</td>
                        <td class="violet">int</td>
                        <td class="green">(none)</td>
                        <td>1 - 5</td>
                        <td class="darkblue">5</td>
                        <td>yes</td>
                      </tr>
                      <tr>
                        <td class="darkblue">picture</td>
                        <td class="violet">file</td>
                        <td class="green">(none)</td>
                        <td></td>
                        <td class="darkblue"></td>
                        <td>no</td>
                      </tr>
                    </tbody>
                  </table>
                  
                  <h3>login.php</h3>
                  <i>Returns: if success: User ID (int), if failed: Error Message (string)</i>
                  <p>Used in (App): Login Page</p>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>PARAMETER</th>
                        <th>TYPE</th>
                        <th>DEFAULT</th>
                        <th>DESCRIPTION</th>
                        <th>EXAMPLE</th>
                        <th>REQUIRED</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="darkblue">username</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td></td>
                        <td class="darkblue">bjarne</td>
                        <td>yes</td>
                      </tr>
                      <tr>
                        <td class="darkblue">password</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td></td>
                        <td class="darkblue">ThePassword2324</td>
                        <td>yes</td>
                      </tr>
                    </tbody>
                  </table>

                  <h3>register.php</h3>
                  <i>Returns: if success: User ID (int), if failed: "(Error Message)" (string)</i>
                  <p>Used in (App): Registration Page</p>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>PARAMETER</th>
                        <th>TYPE</th>
                        <th>DEFAULT</th>
                        <th>DESCRIPTION</th>
                        <th>EXAMPLE</th>
                        <th>REQUIRED</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="darkblue">username</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td></td>
                        <td class="darkblue">bjarne</td>
                        <td>yes</td>
                      </tr>
                      <tr>
                        <td class="darkblue">password</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td></td>
                        <td class="darkblue">ThePassword2324</td>
                        <td>yes</td>
                      </tr>
                      <tr>
                        <td class="darkblue">email</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td></td>
                        <td class="darkblue">bjarne@gmail.com</td>
                        <td>yes</td>
                      </tr>
                    </tbody>
                  </table>

                  <h3>push.php</h3>
                  <i>Returns: Response (string)</i>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>PARAMETER</th>
                        <th>TYPE</th>
                        <th>DEFAULT</th>
                        <th>DESCRIPTION</th>
                        <th>EXAMPLE</th>
                        <th>REQUIRED</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="darkblue">message</td>
                        <td class="violet">string</td>
                        <td class="green">(none)</td>
                        <td>Sends Push Messages/Notifications to Registered Users</td>
                        <td class="darkblue">Hello, New Notification</td>
                        <td>yes</td>
                      </tr>
                    </tbody>
                  </table>

                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div><!--/row-->

  <script>

  $(".thelink").click(function()
  {
    window.open($(this).text(),'_blank');    
  });

  </script>
  
<?php require_once("footer.php"); ?>