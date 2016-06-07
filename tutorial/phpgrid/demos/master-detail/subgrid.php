<?php 
/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 1.5.2
 * @license: see license.txt included in package
 */
 
// include db config
include_once("../../config.php");

// set up DB
mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

// include and create object
include(PHPGRID_LIBPATH."inc/jqgrid_dist.php");

$grid = new jqgrid();

$opt["caption"] = "Clients Data";
$opt["height"] = "";
$opt["rowNum"] = "5";

// following params will enable subgrid -- by default 'rowid' (PK) of parent is passed
$opt["subGrid"] = true;
$opt["subgridurl"] = "subgrid_detail.php";

//call some JS on subgrid load
//$opt["subGridRowExpanded"] = "function(){ setTimeout(function(){ alert('connect ckeditor code'); },200);  }";

$opt["subgridparams"] = "client_id";
// $opt["subgridparams"] = "name,gender,company"; // comma sep. fields. will be POSTED from parent grid to subgrid, can be fetching using $_POST in subgrid
$grid->set_options($opt);

$grid->table = "clients";
$out = $grid->render("list1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<link rel="stylesheet" type="text/css" media="screen" href="../../lib/js/themes/start/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="../../lib/js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<script src="../../lib/js/jquery.min.js" type="text/javascript"></script>
	<script src="../../lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="../../lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="../../lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
</head>
<body>
	<div style="margin:10px">
	Subgrid example ... this file will load subgrid defined in 'subgrid_detail.php'
	<br>
	<br>
	<?php echo $out?>
	</div>
	<script type="text/javascript">
	jQuery(document).ready(function(){

		jQuery('#list1').jqGrid('navButtonAdd', '#list1_pager', 
		{
			'caption'      : 'Toggle Expand', 
			'buttonicon'   : 'ui-icon-plus', 
			'onClickButton': function()
			{
				
				var rowIds = jQuery("#list1").getDataIDs();
				
				if ( ! jQuery(document).data('expandall') )
				{
					jQuery.each(rowIds, function (index, rowId) { jQuery("#list1").expandSubGridRow(rowId); });
					jQuery(document).data('expandall',1);
				}
				else
				{
					jQuery.each(rowIds, function (index, rowId) { jQuery("#list1").collapseSubGridRow(rowId); });
					jQuery(document).data('expandall',0);
				}
				
			},
			'position': 'last'
		});
	});
	</script>	
</body>
</html>
