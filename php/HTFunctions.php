<?php

function GetEmailLink($emailaddr) {		

	if(isset($emailaddr) && ($emailaddr != '')) {

		echo '<a href="'.emailAddressEncode("mailto:".$emailaddr).'">'.emailAddressEncode($emailaddr).'</a>';

	}
}			   

function emailAddressEncode($in_email) {		
		
	echo htmlentities($in_email);

}		

?>