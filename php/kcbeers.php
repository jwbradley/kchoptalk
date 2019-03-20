<?php
			include '../php/HTFunctions.php';
			include('./header.php' );
?>
</head>  
<body>
<?php
			include('./menu.php' );			
?>


<table width="100%"> 
<tr valign=top  > 

<td width="25%"><br /><br />
	<a class="twitter-timeline" href="https://twitter.com/KCHopTalk/kc-bars-clubs-pubs" data-widget-id="330729628186591233">Tweets from @KCHopTalk/kc-bars-clubs-pubs</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</td>


<td align="left" width="60%">

	<div align="center">
		<iframe width="100%" height="800px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?near=Kansas+City,+MO&amp;geocode=CXTAuVw0WbADFU6dVAIdedhc-imXmemvXvfAhzGiUapq5iWFVQ&amp;q=Beer&amp;f=l&amp;hl=en&amp;sll=39.099726,-94.578567&amp;sspn=0.768387,1.271667&amp;ie=UTF8&amp;hq=Beer&amp;hnear=&amp;t=m&amp;fll=39.050119,-94.586792&amp;fspn=0.768932,1.271667&amp;st=114169040791935232566&amp;rq=1&amp;ev=zo&amp;split=1&amp;ll=39.051185,-94.586792&amp;spn=1.279761,1.645203&amp;z=9&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?near=Kansas+City,+MO&amp;geocode=CXTAuVw0WbADFU6dVAIdedhc-imXmemvXvfAhzGiUapq5iWFVQ&amp;q=Beer&amp;f=l&amp;hl=en&amp;sll=39.099726,-94.578567&amp;sspn=0.768387,1.271667&amp;ie=UTF8&amp;hq=Beer&amp;hnear=&amp;t=m&amp;fll=39.050119,-94.586792&amp;fspn=0.768932,1.271667&amp;st=114169040791935232566&amp;rq=1&amp;ev=zo&amp;split=1&amp;ll=39.051185,-94.586792&amp;spn=1.279761,1.645203&amp;z=9&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small>
	</div>

</td>
<td align="right" width="15%"> 
		<table class="Advertise">	
			<thead>
				<th><b>Advertise on <br />KC Hop Talk</b></th>
			</thead>
			<tbody>
				<tr><td align="middle">Place your advertisement for Craft Beer related items on our site.</td></tr>
			</tbody>
			<tfoot>
				<tr><td><?php  GetEmailLink('advertise@kchoptalk.com'); ?>
				</td></tr>
			</tfoot>
		</table>
</td>

</tr>
</table>

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