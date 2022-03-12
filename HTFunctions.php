<?php

date_default_timezone_set('America/Chicago');

function GetEmailLink($emailaddr) {		

	$emailIn = (!is_array($emailaddr) ? array($in_email) : $emailaddr );

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

function emailAddressEncode($in_email) {		
	
	$email = (!is_array($in_email) ? array($in_email) : $in_email );
	
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

?>