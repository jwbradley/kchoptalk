<?php	
			include '../php/HTFunctions.php';
			include('../php/header.php' );
?>
</head>  
<body>
<?php
			include('../php/menu.php' );
			
?>



<div align="center">
	<b><font face="Georgia" color="#800000" size="10">Events Calendar</font></b></p>
	<b><font face="Georgia" size="4">
	<a style="text-decoration:none" href=" <?php emailAddressEncode('KCHopTalk@kchoptalk.com'); ?> ?subject=Kansas City Hop Talk Calendar Listing">Click here to submit a New Listing</a></font>
	</b><br>

	<iframe src="https://www.google.com/calendar/embed?title=KC%20Hop%20Talk%20Events%20Calendar&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=kchoptalk%40gmail.com&amp;color=%232F6309&amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%232952A3&amp;ctz=America%2FChicago" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>
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