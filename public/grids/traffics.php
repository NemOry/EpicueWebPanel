<!--SCRIPTS-->
<script src="public/jqueryui/js/jquery-1.9.1.js"></script>
<script src="public/jqueryui/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="public/js/i18n/grid.locale-en.js"></script>
<script src="public/js/jquery.jqGrid.min.js"></script>
<!--STYLES-->
<link rel="stylesheet" href="public/jqueryui/css/smoothness/jquery-ui-1.10.3.custom.min.css" />
<link href="public/css/ui.jqgrid.css" rel="stylesheet" media="screen" />

<script>

  $(function()
  {
    var last_clicked_id = 0;
    var lastSel = 0;

    function accessFormat( cellvalue, options, rowObject )
    {
      if(cellvalue == 1)
      {
        return "ENABLED";
      }
      else if(cellvalue == 0)
      {
        return "DISABLED";
      }
    }

    function statusFormat( cellvalue, options, rowObject )
    {
      if(cellvalue == 1)
      {
        return "PENDING";
      }
      else if(cellvalue == 0)
      {
        return "APPROVED";
      }
    }

    function  imageFormat(cellvalue, options, rowObject)
    {
      if(cellvalue)
      {
        return "<img src='data:image/jpeg;base64, "+cellvalue+"' style='height:25px;' />";

      }
      else
      {
        return "NONE";
      }
    }

    jQuery("#grid_traffics").jqGrid({
        url:'public/grids/traffics_xml.php',
        datatype: 'xml',
        mtype: 'GET',
        colNames:[
        'ACTION', 
        'ID', 
        'PICTURE', 
        'USER ID', 
        'STORE ID', 
        'RATING / STATUS', 
        'COMMENT', 
        'STATUS',
        'ENABLED',
        'CREATED'
        ],
        colModel :[ 
          {name:'act',index:'act', width:8,sortable:false, search: false},
          {name:'id', index:'id', width:3, align:'left', sortable:true, search:true},
          {name:'picture', index:'picture', width:5, align:'left', sortable:false, editable:false, formatter:imageFormat},
          {name:'userid', index:'userid', width:5, align:'left', sortable:true, editable:true, editoptions: {size:30}, search:true},
          {name:'storeid', index:'storeid', width:5, align:'left', sortable:true, editable:true, editoptions: {size:30}, search:true},
          {name:'status', index:'status', width:5, align:'left', sortable:true, editable:true, editoptions: {size:30}, search:true},
          {name:'comment', index:'comment', width:10, align:'left', sortable:true, editable:true, editoptions: {size:30}, search:true},
          {name:'pending', index:'pending', width:5, align:'left', sortable:true, editable:true, search:true, formatter:statusFormat, edittype:'select', editoptions:{value:{1:'PENDING', 0:'APPROVED'}}},
          {name:'enabled', index:'enabled', width:5, align:'left', sortable:true, editable:true, search:true, formatter:accessFormat, edittype:'select', editoptions:{value:{1:'ENABLED', 0:'DISABLED'}}},
          {name:'datetime', index:'datetime', width:5, align:'left', sortable:true, editable:false, editoptions: {size:30}, search:true},
        ],
        width: 1300,
        height: 400,
        pager: '#nav_traffics',
        rowNum:30,
        rowList:[10,20,30,40,50,100,200,300,400,500],
        sortname: 'id',
        sortorder: 'desc',
        gridComplete: function()
        {
          var ids = jQuery("#grid_traffics").jqGrid('getDataIDs');
          for(var i=0;i < ids.length;i++)
          {
            var id = ids[i];
            edit = "<button class='ui-state-default ui-corner-all' onclick=\"jQuery('#grid_traffics').editGridRow('"+id+"', {width:300}); jQuery('#grid_traffics').trigger('reloadGrid');\"><span class='ui-icon ui-icon-pencil'></span></button>"; 
            del = "<button class='ui-state-default ui-corner-all' onclick=\"jQuery('#grid_traffics').delGridRow('"+id+"'); jQuery('#grid_traffics').trigger('reloadGrid');\"><span class='ui-icon ui-icon-trash'></span></button>";
            save = "<button class='ui-state-default ui-corner-all' onclick=\"jQuery('#grid_traffics').saveRow('"+id+"'); jQuery('#grid_traffics').trigger('reloadGrid');\" ><span class='ui-icon ui-icon-check'></span></button>"; 

            jQuery("#grid_traffics").jqGrid('setRowData',ids[i],{act:edit+del+save}); 
          }
        },
        editurl: "public/grids/traffics_manipulate.php",
        viewrecords: true,
        gridview: true,
        caption: 'traffics',
        multiselect:true,
        onSelectRow: function(id)
        {
         if(id && id!==lastSel)
         { 
            jQuery('#grid_traffics').retrafficRow(lastSel); 
            lastSel=id; 
         }

        jQuery('#grid_traffics').editRow(id); 
       }
    });

  jQuery("#grid_traffics").jqGrid('navGrid','#nav_traffics',{edit:isSuperAdmin, add:isSuperAdmin, del:isSuperAdmin});

  jQuery("#grid_traffics").
    navButtonAdd('#nav_traffics',{
       caption:"Delete", 
       buttonicon:"ui-icon-circle-minus", 
       onClickButton: function()
       {
          var ids = jQuery("#grid_traffics").jqGrid('getGridParam','selarrrow');

          if(ids.length > 0)
          {
            if(confirm("Delete selected traffics?"))
            {
              $.ajax({
                type:"POST",
                url:"public/grids/multi_delete.php",
                data: {ids:ids, what:"traffic"},
                success: function(result)
                {
                    if(result == "success")
                    {
                        jQuery("#grid_traffics").trigger("reloadGrid");
                        return false;
                    }
                    else
                    {
                        bootbox.alert(result);
                        return false;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    bootbox.alert("error");
                    return false;
                }
              });
            }
          }
          else
          {
            bootbox.alert("please select atleast one");
          }
          return false;
       },
       position:"last"
    }).
    navButtonAdd('#nav_traffics',{
       caption:"Disable", 
       buttonicon:"ui-icon-circle-close", 
       onClickButton: function(){

          var ids = jQuery("#grid_traffics").jqGrid('getGridParam','selarrrow');

          if(ids.length > 0)
          {
            if(confirm("Disable selected traffics?"))
            {
              $.ajax({
                type:"POST",
                url:"public/grids/multi_disable.php",
                data: {ids:ids},
                success: function(result)
                {
                    if(result == "success")
                    {
                        jQuery("#grid_traffics").trigger("reloadGrid");
                        return false;
                    }
                    else
                    {
                        bootbox.alert(result);
                        return false;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    bootbox.alert("error");
                    return false;
                }
              });
            }
          }
          else
          {
            bootbox.alert("please select atleast one");
          }
          return false;
       },
       position:"last"
    }).
    navButtonAdd('#nav_traffics',{
       caption:"Enable", 
       buttonicon:"ui-icon-circle-check", 
       onClickButton: function(){

          var ids = jQuery("#grid_traffics").jqGrid('getGridParam','selarrrow');

          if(ids.length > 0)
          {
            if(confirm("Enable selected traffics?"))
            {
              $.ajax({
                type:"POST",
                url:"public/grids/multi_enable.php",
                data: {ids:ids},
                success: function(result)
                {
                    if(result == "success")
                    {
                        jQuery("#grid_traffics").trigger("reloadGrid");
                        return false;
                    }
                    else
                    {
                        bootbox.alert(result);
                        return false;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    bootbox.alert("error");
                    return false;
                }
              });
            }
          }
          else
          {
            bootbox.alert("please select atleast one");
          }
          return false;
       },
       position:"last"
    });
});

</script>

<table id="grid_traffics"><tr><td/></tr></table> 
<div id="nav_traffics"></div>