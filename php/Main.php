<?php
			include '../php/HTFunctions.php';
			include('./header.php' );
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

</head>  
<body>
<?php
			include('./menu.php' );
			
?>






<br /><br />

<div align="center">
	<div class="about">			
		<table width="100%">  
			<tr > 
				<td width="25%" valign="top" align="center">
					<a href="../fest/brewfest/brewfest2015.php" target="_blank"><img src="../fest/brewfest/kcbrewfestlogo_w.jpg" alt="KANSAS CITY BREW FESTIVAL" height="215" width="145"></a><br>
					<a href="../fest/blarneybrew/brewoff2015.php" target="_blank"><img src="../fest/blarneybrew/brewoff.png" alt="2015 Blarney Brew Off" height="215" width="215"></a><br>
					<a href="../fest/parkville/parkville2015.php" target="_blank"><img src="../fest/parkville/Microbrew-Fest-Logo.png" alt="Parkville Microbrew Festival" height="205" width="215"></a><br>
					<a href="../fest/kcontap/kcontap.php" target="_blank"><img src="../fest/kcontap/kcontap.png" alt="KC On Tap Beer Festival" height="180" width="240"></a><br>
					<!-- <a href="../fest/irishfest.php" target="_blank"><img src="../fest/irishfest/kcif_logo.jpg" alt="KC Irish Festival" height="205" width="205"></a><br> -->
					<!-- <a href="../fest/haus2014.php" target="_blank"><img src="../fest/haus/kchausfest.jpg" alt="KC haus October Festival" height="95" width="205"></a><br> -->
					<!-- <a href="../fest/beer-vs-wine.php" target="_blank"><img src="../fest/beer-vs-wine/beer-vs-wine.jpg" alt="KC Nano Fest" height="165" width="170"></a> -->
					<p><br/></p>
                </td>
				<td valign="top" align="left" width="50%">
            <p>KC Hop Talk is constantly looking out for news and information related to craft beers and craft brewing that directly impacts the Kansas City Craft Beer Consumers.</p>					
            <p>Our goal is to challenge the 'status-quo' of other beer sites, by pushing the envelop towards finding the latest news and events related to craft beer and craft brewing in the Kansas City Regional Market.</p>
				</td></td>
				<td width="25%" valign="top" >
					<a href="https://beerloved.refersion.com/c/e598" target="_blank"><img src="../affiliates/BeerLoved_300x250.gif" alt="KC Nano Fest" height="250" width="300"> 
				</td>
			</tr>
		</table>
	</div>
	<br />
	<script src="//www.gmodules.com/ig/ifr?url=http://www.beerlabels.com/gmod/beer.xml&amp;synd=open&amp;w=320&amp;h=130&amp;title=Beer+of+the+Day&amp;border=%23ffffff%7C0px%2C1px+solid+%2399BB66%7C0px%2C2px+solid+%23AACC66%7C0px%2C2px+solid+%23BBDD66&amp;output=js"></script>
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