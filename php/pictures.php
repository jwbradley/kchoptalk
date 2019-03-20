<?php include("KCHTfunctions.php"); 
ini_set("memory_limit","256M");
ini_set("max_execution_time","180");
 


$InPath = htmlspecialchars($_GET['path']);
$Dir = opendir($InPath);
$imagesPath =  '';
$thumbPath =   'thumbs/';	

echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
echo "<html><head>";
echo " <link rel=\"shortcut icon\" href=\"../Pics/camera2.ico\" type=\"image/x-icon\"> \n";
echo "  <title>Show Picture In Directories</title>\n";
echo " <script type=\"text/javascript\" src=\"../Script/jquery.min.js\"></script> \n";
echo "</head><body>\n";
echo '<form><input type="button" value="BACK" onclick="window.location.href=\'Main.php\'">'."\n";
echo "<hr />\n";

while (($oneRecord = readdir($Dir)) !== false) {	
	if ((strpos(strtoupper($oneRecord), '.JPG') !== false) &&
	    (strpos(strtoupper($oneRecord), 'THUMBS') !== true) )   	{
		$image_path = $InPath.'/'.$oneRecord;
		$image_thumb = $InPath.'/'.$thumbPath.$oneRecord;
		$size = getimagesize($image_path);		
	
		//specify what percentage you are resizing to
		$percent_resizing = 20;

		$new_width = round((($percent_resizing/100)*$size[0]));
		$new_height = round((($percent_resizing/100)*$size[1]));
		if (!file_exists($image_thumb)) 
		{
    		createThumbs( $InPath, $oneRecord, $new_width, $new_height ) ;	
		}
		
		echo "\t<a target=\"_blank\" href=\"".$image_path."\"><img src=\"".$image_thumb."\" border=\"0\" alt=\"".$oneRecord."\" title=\"".$oneRecord."\" id=\"".$oneRecord."\" /><a/>\n";
		}	}

closedir($Dir);

echo "<hr />";
echo '<form><input type="button" value="BACK" onclick="window.location.href=\'Main.php\'">';
echo "</body></html>";
?>