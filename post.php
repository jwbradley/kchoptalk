<?php

if ((isset($_GET['beerlink'])) && (isset($_GET['title'])) ){
	$redirlink  = urldecode($_GET['beerlink']);  // Decode the encoded link
	$redirtitle = urldecode($_GET['title']);  // Decode the encoded title

} else {
	$redirlink  = "http://kchoptalk.com";
	$redirtitle = "Kansas City Hop Talk - Beer News for beer nerds!";
}

$debugger = htmlspecialchars($_GET['debug']);


if($debugger) {

	echo "\n<!-- \$redirlink   = {$redirlink} -->\n";
	echo "\n<!-- \$redirtitle  = {$redirtitle} -->\n";
	
}

$random123 = "beerArticle".rand(10000, 99999);

echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "<head>\n";
echo "\t<meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\" />\n";
echo "\t<meta http-equiv=\"Content-Security-Policy\" content=\"default-src 'self'; script-src 'self' 'nonce-{$random123}' https://www.googletagmanager.com; object-src 'none'; base-uri 'self';\">\n";
echo "\t<title id=\"pagetitle\"></title>\n";
echo "</head>\n";
echo "<body>\n";
echo "\t<div style=\"margin: 60px 300px;\">\n";
echo "\t\t<div align=center>\n";
echo "\t\t\t<h1 id=\"pageheadline\"></h1>\n";
echo "\t\t</div>\n";
echo "\t\t<div>\n";
echo "\t\t\t<p id=redirecttext align=center></p>\n";
echo "\t\t</div>\n";
echo "\t\t<div align=center>\n";
echo "\t\t\t<img border=\"0\" src=\"https://kchoptalk.com/Pics/KCHopTalkLogo-172x172.png\" alt=\"Please Wait\" width=\"172\" height=\"172\">\n";
echo "\t\t</div>\n";
echo "\t</div>\n";
echo "</body>\n";

echo "<!-- Google tag (gtag.js) -->\n<script async src=\"https://www.googletagmanager.com/gtag/js?id=G-966WLPDH79\"></script>\n<script nonce=\"{$random123}\" >\n\twindow.dataLayer = window.dataLayer || [];\n\tfunction gtag(){dataLayer.push(arguments);}\n\tgtag('js', new Date());\n\t\n\tgtag('config', 'G-966WLPDH79');\n</script>\n";

echo "<script nonce=\"{$random123}\">";

echo "</script>\n";
echo "document.getElementById(\"pagetitle\").innerHTML = \"" . $redirtitle . "\";\n";
echo "document.getElementById(\"pageheadline\").innerHTML = \"Opening Article: " . $redirtitle . "\";\n";
echo "document.getElementById(\"redirecttext\").innerHTML = \"Please wait for the external page to load. If the page does not load within the appropriate amount of time, you might need to <a href='" . addslashes($redirlink) . "'>retry the link</a>.\";\n";
echo "function pageRedirect() {\n\twindow.location.replace(\"" . trim($redirlink) . "\");\n}\n";
echo "setTimeout(pageRedirect, 1);\n";
echo "</html>\n";

?>
