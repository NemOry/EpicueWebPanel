    <hr>

    </div><!--/.fluid-container-->
    <script> $.ajaxSetup({ cache: false }); </script>
    <script>

    $.toast.config.align = 'right';
    $.toast.config.closeForStickyOnly = false;
    $.toast.config.width  = 200;

    function showToast(message, type)
    {
      var options = 
      {
        duration: 3000,
        sticky: false,
        type: type
      };

      $.toast(message, options);
    } 

    $('.date').datepicker();

    $(document).ready(function()
    {

      var items = [];
      var map = {};

      $('.search-query').typeahead(
      {
        items: 15,
        source: function (query, process) 
        {
          $.ajax(
          {
            type: 'POST',
            url: 'includes/webservices/search.php',
            data: {input: query},
            success: function(result) 
            {
              if(result != "")
              {
                var jsonArray = JSON.parse(result);

                if($.isArray(jsonArray))
                {
                  for(index = 0; index < jsonArray.length; index++) // tables array
                  {
                    var jsonObjects = jsonArray[index].objects;
                    var tableName   = jsonArray[index].name;

                    if(tableName == "users")
                    {
                      $.each(jsonObjects, function (i, object)
                      {
                        thisObject            = new Object();
                        thisObject.tableName  = tableName;
                        thisObject.object     = object;

                        map[object.username + " " + object.firstname + " " + object.middlename + " " + object.lastname] = thisObject;
                        items.push(object.username + " " + object.firstname + " " + object.middlename + " " + object.lastname);
                      });
                    }
                    else if(tableName == "stores")
                    {
                      $.each(jsonObjects, function (i, object)
                      {
                        thisObject            = new Object();
                        thisObject.tableName  = tableName;
                        thisObject.object     = object;

                        map[object.id + " " + object.name] = thisObject;
                        items.push(object.id + " " + object.name);
                      });
                    }
                    else if(tableName == "products")
                    {
                      $.each(jsonObjects, function (i, object)
                      {
                        thisObject            = new Object();
                        thisObject.tableName  = tableName;
                        thisObject.object     = object;

                        map[object.id + " " + object.name] = thisObject;
                        items.push(object.id + " " + object.name);
                      });
                    }
                    else if(tableName == "traffics")
                    {
                      $.each(jsonObjects, function (i, object)
                      {
                        thisObject            = new Object();
                        thisObject.tableName  = tableName;
                        thisObject.object     = object;

                        map[object.id + " " + object.comment] = thisObject;
                        items.push(object.id + " " + object.comment);
                      });
                    }
                    else if(tableName == "reviews")
                    {
                      $.each(jsonObjects, function (i, object)
                      {
                        thisObject            = new Object();
                        thisObject.tableName  = tableName;
                        thisObject.object     = object;

                        map[object.id + " " + object.review] = thisObject;
                        items.push(object.id + " " + object.review);
                      });
                    }
                  }
                }
              }

              process(items);
              items.length = 0;
            }
          });
        },
        updater: function (item) 
        {
          var object = map[item].object;
          var tableName = map[item].tableName;

          if(tableName == "users")
          {
            window.location.href = "updateuser.php?id="+ object.id;
          }
          else if(tableName == "stores")
          {
            window.location.href = "updatestore.php?id="+ object.id;
          }
          else if(tableName == "products")
          {
            window.location.href = "updateproduct.php?id="+ object.id;
          }
          else if(tableName == "traffics")
          {
            window.location.href = "updatetraffic.php?id="+ object.id;
          }
          else if(tableName == "reviews")
          {
            window.location.href = "updatereview.php?id="+ object.id;
          }
        },
        highlighter: function(item)
        {
            var object = map[item].object;
            var tableName = map[item].tableName;

            var listItem = "";

            if(tableName == "users")
            {
              listItem = ''
                     + "<div class='typeahead_wrapper'>"
                     + "<div class='typeahead_labels'>"
                     + "<div class='typeahead_primary'>" + object.firstname + " " + object.middlename[0] + ". " + object.lastname + "</div>"
                     + "<div class='typeahead_secondary'>" + object.username + "</div>"
                     + "</div>";
            }
            else if(tableName == "stores")
            {
              listItem = ''
                     + "<div class='typeahead_wrapper'>"
                     + "<div class='typeahead_labels'>"
                     + "<div class='typeahead_primary'>" + object.name + "</div>"
                     + "<div class='typeahead_secondary'>" + object.branchname + "</div>"
                     + "</div>";
            }
            else if(tableName == "products")
            {
              listItem = ''
                     + "<div class='typeahead_wrapper'>"
                     + "<div class='typeahead_labels'>"
                     + "<div class='typeahead_primary'>" + object.name + "</div>"
                     + "<div class='typeahead_secondary'>" + object.description + "</div>"
                     + "</div>";
            }
            else if(tableName == "traffics")
            {
              listItem = ''
                     + "<div class='typeahead_wrapper'>"
                     + "<div class='typeahead_labels'>"
                     + "<div class='typeahead_primary'>" + object.comment + "</div>"
                     + "<div class='typeahead_secondary'>" + object.status + "</div>"
                     + "</div>";
            }
            else if(tableName == "reviews")
            {
              listItem = ''
                     + "<div class='typeahead_wrapper'>"
                     + "<div class='typeahead_labels'>"
                     + "<div class='typeahead_primary'>" + object.review + "</div>"
                     + "<div class='typeahead_secondary'>" + object.rating + "</div>"
                     + "</div>";
            }

            return listItem;
        }
      });

      $('.search-query').typeahead.Constructor.prototype.render = function (items) 
      {
        var that = this;

        items = $(items).map(function (i, item) 
        {
          var elements = [];

          if (item === "separator") 
          {
            elements.push($("<li/>").addClass("divider")[0]);
          }
          else
          {
            i = $(that.options.item).attr('data-value', item);
            i.find('a').html(that.highlighter(item));
            elements.push(i[0]);
          }

          return elements;
        });

        items.first().addClass('active');
        this.$menu.html(items);

        return this;
      }

      var message       = "<?php echo $message; ?>";
      var currentFile   = "<?php echo $currentFile; ?>";

      if(message != "")
      {
        bootbox.alert(message);
      }

      if(currentFile == "index")
      {
        $("#index").addClass("active");
        document.title = 'Epicue';
      }
      else if(currentFile == "createuser")
      {
        $("#createuser").addClass("active");
        $("#createdropdown").addClass("active");
        document.title = 'Create User - Epicue';
      }

      $('#myTab a').click(function (e) 
      {
        e.preventDefault();
        $(this).tab('show');
      });

    });

    $('.mytooltip').tooltip();

    </script>
    <script> $.ajaxSetup({ cache: false }); </script>
  </body>
</html>