<!DOCTYPE html>
<html>
<head>
	<META HTTP-EQUIV="refresh" CONTENT="1800">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<?php
// error_reporting(E_ALL ^ E_NOTICE);
    ini_set("error_log", "./logs/BeerErrors.log");
if ((isset($_GET['l'])) && (isset($_GET['t'])) ){
	// $redirlink  = urldecode(base64_decode(htmlspecialchars($_GET['l'])));  // Decode the encoded link
	// $redirtitle = urldecode(base64_decode(htmlspecialchars($_GET['t'])));  // Decode the encoded title
	$redirlink  = urldecode($_GET['l']);  // Decode the encoded link
	$redirtitle = urldecode($_GET['t']);  // Decode the encoded title

} else {
	$redirlink  = "http://kchoptalk.com";
	$redirtitle = "Kansas City Hop Talk - Beer News for beer nerds!";
}

$debugger = htmlspecialchars($_GET['debug']);


if($debugger) {

	echo "\n<!-- \$redirlink   = {$redirlink} -->\n";
	echo "\n<!-- \$redirtitle  = {$redirtitle} -->\n";
	
}

// echo "\n\t<meta charset=\"utf-8\">\n\t<meta http-equiv=\"refresh\" content=\"0;URL='".$redirlink."'\"/>\n\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n"; 
echo "\t<title>".$redirtitle."</title>\n";
?>
	<meta name="author" content="James Bradley" >
	<meta name="copyright" content="Copyright 2012-<?php echo date("Y"); ?> KC Hop Talk">
	
	<meta property="og:title" content="<?php echo $redirtitle; ?>"/>
	<meta property="og:url" content="<?php echo $redirlink; ?>" />

	</head>
	<body>
		
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-37565453-19"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-37565453-19');
	</script>
 
    <script language="javascript">
        <?php echo "window.open('".trim($redirlink)."', '_parent', '');"; ?>
    </script>

	</body>
</html>
