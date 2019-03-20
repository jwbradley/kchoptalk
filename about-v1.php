<?php
			include './php/HTFunctions.php';
			include('./php/header.php' );
?>

<style type="text/css">
#footer_container 
{
	background:#eee; 
	border:3px solid #665; 
	bottom:0;
	height:45px; 
	left:0; 
	position: fixed;
	width: 100%;
}
</style>
<link href='http://fonts.googleapis.com/css?family=PT+Mono' rel='stylesheet' type='text/css'>


	<meta http-equiv="refresh" content="0; URL='./index.php'" />


</head>  
<body>
<?php
			include('./php/menu.php' );
			
?>






<br /><br />

<div align="center">
	<div class="about">			
		<table width="100%">  
			<tr > 
				<td width="15%" valign="top" align="center">
					<p><br/></p>
                </td>
				<td valign="top" align="left" width="70%" style="font-size: 16pt; font-family: 'PT Mono';">
		            <p>KC Hop Talk focuses on Beer News for Kansas City Beer Nerds, by looking for information pertaining to Craft Beer in the Kansas City area.</p>
		            <p>KC Hop Talk is constantly looking out for news and information related to craft beers and craft brewing that directly impacts the Kansas City Craft Beer Consumers.</p>
		            <p>Our goal is to challenge the 'status-quo' of other beer sites, by pushing the envelop towards finding the latest news and events related to craft beer and craft brewing in the Kansas City Regional Market.</p>
				</td>
				<td width="15%" valign="top" >
					
				</td>
			</tr>
		</table>
	</div>
	<br />
	
</div>

   <div id="footer_container">
   	<table class="footer">	
			<tbody>
				<tr>
					<td></td>
				   <td><?php CRDate2(); ?></td>
				   <td></td>
				</tr>
			</tbody>
		</table>
	</div>

</body>
</html>