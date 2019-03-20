<?php

date_default_timezone_set('America/Chicago');

function GetEmailLink($emailIn)
{		
	$cf = fopen('./php/HTML_Codes.txt', 'r');

	$mail2 = "&#109;&#97;&#105;&#108;&#116;&#111;&#58;";

	$looper = count($emailIn);
	$loop1 = 0;

	while (!feof($cf)) 
	{
		$sysline = fgets($cf);      
		$Sys_CMT[$loop1] = explode(",", $sysline); 
		$loop1++;
	}
	fclose($cf);

	$letters = strlen($emailIn);

	for ($z = 0; $z <= $letters-1; $z++)
	{
		for ($jj = 0; $jj <= $loop1 -1; $jj++)
		{
			if (substr($emailIn,$z,1) == $Sys_CMT[$jj][3])
			{
				// Encode letters in HTML formatting codes
				$emailOut  .= $Sys_CMT[$jj][0]; 
			}
		}
	}
	echo '<a href="'.$mail2.$emailOut.'">'.$emailOut.'</a>';
}			   

function emailAddressEncode($email)
{		
	$cf = fopen('./php/HTML_Codes.txt', 'r');

	$mailto = "&#109;&#97;&#105;&#108;&#116;&#111;&#58;";

	$looper = count($email);
	$loop1 = 0;

	while (!feof($cf)) 
	{
		$sysline = fgets($cf);      
		$Sys_CMT[$loop1] = explode(",", $sysline); 
		$loop1++;
	}
	fclose($cf);

	$letters = strlen(trim($email));
	$output  = '';

	for ($z = 0; $z <= $letters-1; $z++)
	{
		for ($jj = 0; $jj <= $loop1 -1; $jj++)
		{
			if (substr($email,$z,1) == $Sys_CMT[$jj][3])
			{
				// Encode letters in HTML formatting codes
				$output  .= $Sys_CMT[$jj][0]; 
			}
		}
	}
	echo $mailto.$output;
}		

function outputTable($tableValues, $headerValues)
{
	echo "<center>\n";
	
	echo '<table id="MODivList" class="tablesorter" WIDTH="1000" border="1" cellpadding="1" cellspacing="1" >' ."\n";
	echo '<thead><tr>' ."\n";
	
	foreach($headerValues as $key=>$header) 
	{
		echo '<th rowspan="1" style="vertical-align: bottom; text-align: center;"><b>'.$header.'</b></th>' ."\n";
	}

	echo '</tr></thead>'."\n";

	echo '<tbody>' ."\n";
    
	foreach($tableValues as $key=>$row) 	
	{
		echo "<tr>";
		
		foreach($row as $key2=>$column)
		{   	   
			if (trim($column) <> '')
			{
				echo "<td>".trim($column)." </td>";	
			} 
			else
			{
				echo "<td>&nbsp;</td>";
			}
		} 
		echo "</tr>\n";
	}

	echo '</tbody>' ."\n";
	echo '</table>' ."\n";
	echo "</center>\n";
		
	echo '<script defer="defer">' ."\n";
	echo '	$(document).ready(function() ' ."\n";
	echo '    { ' ."\n";
	echo '        $("#MODivList")' ."\n";
	echo '		.tablesorter({widthFixed: true, widgets: [\'zebra\']}); ' ."\n";
	echo '    } ' ."\n";
	echo '	); ' ."\n";
	echo '</script>' ."\n";	

}



function LinkTableOutput($tablename, $tableValues, $headers)
{
	echo "<center>\n";
	
	echo '<table id="'.$tablename.'" class="tablesorter" border="1" cellpadding="1" cellspacing="1" >' ."\n";
	echo "<thead><tr>\n";
	
	foreach($headers as $key=>$header) 
	{
		echo '<th rowspan="1" style="vertical-align: bottom; text-align: center;"><b>'.$header.'</b></th>' ."\n";
	}	

	echo '</tr></thead>'."\n";

	echo '<tbody>' ."\n";
    
	foreach($tableValues as $key=>$row) 	
	{
		echo "<tr>";
		
		foreach($row as $key2=>$column)
		{   	   
			if ($key2 <> 0)
			{
				if (trim($column) <> '') 
				{
					echo "<td><A href=\"./GraveInfo.php?grvid=".$tableValues[$key][0]."\"  style=\"text-decoration: none; color: black\"  onmouseover=\"this.style.color='#FF0000'\"  onmouseout=\"this.style.color='black'\"  target=\"main\">".trim($column)."</td>\n";  
				} 
				else
				{
					echo "<td>&nbsp;</td>";
				}
			}
		} 
		echo "</tr>\n";
	}

echo '</tbody>' ."\n";
echo '</table>' ."\n";
echo "</center>\n";
	
echo '<script defer="defer">' ."\n";
echo '	$(document).ready(function() ' ."\n";
echo '    { ' ."\n";
echo '        $("#'.$tablename.'")' ."\n";
echo '		.tablesorter({widthFixed: true, widgets: [\'zebra\']}); ' ."\n";
echo '    } ' ."\n";
echo '	); ' ."\n";
echo '</script>' ."\n";	

}

function add2page($adding)
{
	$headerFile = './php/HTML/'.$adding;
	$file     = fopen($headerFile, 'r');
		  
	while (!feof($file)) 
	{
		$myline = fgets($file);
		echo $myline;
	}
        fclose($file);
}


function CRDate2()
{
	echo '<font size="2">';	
	echo '<div id="twitter">
          <a href="http://twitter.com/KCHopTalk" target="_blank"><img alt="Twitter" width="25" height="25"  src="./Pics/twitter_32.png" /></a>
        </div>

        <div id="facebook">
          <a href="https://www.facebook.com/KCHopTalk" target="_blank"><img alt="facebook" width="25" height="25"  src="./Pics/f_logo.png" /></a>
        </div>

        <div id="instagram">
          <a href="http://instagram.com/kchoptalk?ref=badge" target="_blank"><img alt="Instagram" src="./Pics/ig-badge-48.png" width="25" height="25" /></a>
        </div>

        <div id="googleplus">
          <a href="https://plus.google.com/108075757565795197769/posts" target="_blank"><img alt="GooglePlus" src="./Pics/Google-plus.png" width="25" height="25" /></a>
        </div>

        <div id="pinterest">
          <a href="https://www.pinterest.com/kchoptalk/" target="_blank"><img alt="Pinterest" src="./Pics/pinterest.png" width="25" height="25" /></a>
        </div>

        <div id="untappd">
          <a href="https://untappd.com/user/KCHopTalk" target="_blank"><img alt="Untappd" src="./Pics/untappd.jpeg" width="25" height="25" /></a>
        </div>

        <div id="ratebeer">
          <a href="http://www.ratebeer.com/user/276207/" target="_blank"><img alt="Rate Beer" src="./Pics/rate+beer.png" width="25" height="25" /></a>
        </div>

        <div id="reddit">
          <a href="https://www.reddit.com/r/KCHopTalk/" target="_blank"><img alt="Rate Beer" src="./Pics/reddit.png" width="25" height="25" /></a>
        </div>';
	echo 'Copyright&copy 2012-'. date("Y").'&nbsp; All Rights Reserved.<br /?>Website by <a href="http://kchoptalk.com" style="text-decoration: none;font-weight:bold;">KC Hop Talk, KC, MO, USA</a> </font>';
}
 

function linkfilter($inLink){

	$ignore = file_get_contents("./docs/ignoreListing.json");
	$linkIgnore = json_decode($ignore, true); 

	foreach($linkIgnore as $key => $row ) {
		if($inLink == $row["link"]){
			return '1inkSkip';
		}
	}
	return '';
}


?>
