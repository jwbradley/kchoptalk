<?php
function counter($cookiecounter)
{
	if(isset($_COOKIE[$cookiecounter])) 
	{
		$cookie = $_COOKIE[$cookiecounter];
		// setcookie($cookiecounter,"1",time()+3600,"/");
	} 
	else 
	{
		$count_my_page  = '../Counters/'.$cookiecounter.'.txt';
		$pagehitcounter = file($count_my_page);
		$fp = fopen($count_my_page , "w");
		$pagehitcounter[0] ++;
		setcookie($cookiecounter,$pagehitcounter[0],time()+72000,"/");
		fputs($fp , $pagehitcounter[0]);
		fclose($fp);
	}
}

function add2page($adding)
{
	$headerFile = '../HTML/'.$adding;
	$file     = fopen($headerFile, 'r');
		  
	while (!feof($file)) 
	{
		$myline = fgets($file);
		echo $myline;
	}
        fclose($file);
}

function counteroutput($counterpage)
{
echo '<center>Page Hit Count:&nbsp; ';
$count_my_page2  = '../Counters/'.$counterpage;
$pagehitcounter2 = file($count_my_page2);
echo $pagehitcounter2[0];
echo '</center>';
}

function listDirs($directory, $counter)
{	
	
	global $Tree;
	global $counter;
	$Dirs = opendir($directory);
	while (($file = readdir($Dirs)) !== false) 
	{
		if(($file != '.') && ($file != '..') && (strtoupper($file) != 'THUMBS'))
		{
			if (is_dir($directory."/".$file))  
			{
				$Tree[$counter] = $directory."/".$file;
				listDirs($Tree[$counter], $counter++);
			} 
		}
	}
	closedir($Dirs);
	
}

function countImages($imagepath)
{
	$pictures = 0;
	$listing = opendir($imagepath);
		while (($jpgCntr = readdir($listing)) !== false) 
	{
		if ( (strpos(strtoupper($jpgCntr), '.JPG') !== false) &&
           (strpos(strtoupper($jpgCntr), 'THUMBS') !== true) )   
		{
				$pictures++;
		}
	}
	closedir($listing);
	return $pictures;
}


function createThumbs( $pathToImages, $image, $thumbWidth, $thumbHeight ) 
{
	$pathToThumbs = $pathToImages."/thumbs/";	
	$pathToImages .= '/';
	$imgPath = $pathToImages . $image;
	
	if (!is_dir($pathToThumbs))	
	{ 
		mkdir($pathToThumbs, 0777); 	
	}
	
	
      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = $thumbHeight;

      // create a new tempopary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );
      
      // load image and get image size
      $img = imagecreatefromjpeg( $imgPath );
      
      $width = imagesx( $img );
      $height = imagesy( $img );
      
      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, $pathToThumbs.$image );
      
      ImageDestroy($img); 
      ImageDestroy($tmp_img);
 
}

function listImages( $pathToImages ) 
{
	$Dir = opendir($pathToImages);
	$imagesPath =  '../KCHTBeers';
	
	global $imageOne;
	global $imageCounter;
	$imageCounter = 1;
			
	while (($oneRecord = readdir($Dir)) !== false) 
	{	
		if (($file != '.') && ($file != '..') && (strpos(strtoupper($oneRecord), '.JPG') !== false)  )   	
	   {
			$image_path = $imagesPath.'/'.$oneRecord;
			
			echo "var image".$imageCounter."=new Image()\n";
			echo "    image".$imageCounter.".src=\"".$image_path."\"\n";		
			
			if ($imageCounter == 1)
			{
				$imageOne = $image_path;
			}
			$imageCounter++;
		}	
		
	}
	closedir($Dir);
	
}

?>
