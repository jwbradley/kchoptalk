
<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once 'excel_reader2.php';

$data = new Spreadsheet_Excel_Reader("../docs/2014BeersList.xls");
?>


<!DOCTYPE html> 
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Display Excel Spreadsheet</title> 
	
	<meta name="author" content="KC Hop Talk">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta http-equiv="cleartype" content="on">
	
	<style type="text/css">a {text-decoration: none;}</style>
	
	<style>
		table.excel {
			border-style:ridge;
			border-width:1;
			border-collapse:collapse;
			font-family:sans-serif;
			font-size:12px;
		}
		table.excel thead th, table.excel tbody th {
			background:#CCCCCC;
			border-style:ridge;
			border-width:1;
			text-align: center;
			vertical-align:bottom;
		}
		table.excel tbody th {
			text-align:center;
			width:20px;
		}
		table.excel tbody td {
			vertical-align:bottom;
		}
		table.excel tbody td {
			padding: 0 3px;
			border: 1px solid #EEEEEE;
		}
	</style>
<body>

<p><?php echo $data->dump(true,true); ?></p>	


</body>
</html>	