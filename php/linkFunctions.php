<?php

function getrec() 
{
	$dbhost = "localhost";
	$db = "postpage";
	$dbuser  = "root";
	$dbpass  = "admin";

	
	$link = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

	if (!$link) {
    	die('Connect Error (' . mysqli_connect_errno() . ') '
                            . mysqli_connect_error());
	} 			
			
	$sql = "select * from postpage.`links` where `rnum` in ( select max(`rnum`) from postpage.`links`)";
	echo "\n<!--  {$sql} -->\n<br />";
	
	$db_found    = mysqli_query($link, $sql); 

	$row = mysqli_fetch_row($db_found);
	
	mysqli_close($link);

 	return $row;
}

function getmax() 
{
	$dbhost = "localhost";
	$db = "postpage";
	$dbuser  = "root";
	$dbpass  = "admin";

	
	$link = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

	if (!$link) {
    	die('Connect Error (' . mysqli_connect_errno() . ') '
                            . mysqli_connect_error());
	} 			
			
	$sql = "select lid from postpage.`links` where `rnum` in ( select max(`rnum`) from postpage.`links`)";
	echo "\n<!--  {$sql} -->\n<br />";
	
	$db_found    = mysqli_query($link, $sql); 

	$row = mysqli_fetch_row($db_found);
	
	mysqli_close($link);

 	return $row;
}

function searchrec($urlsrch) 
{
	$dbhost = "localhost";
	$db = "postpage";
	$dbuser  = "root";
	$dbpass  = "admin";

	
	$link = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

	if (!$link) {
    	die('Connect Error (' . mysqli_connect_errno() . ') '
                            . mysqli_connect_error());
	} 			
			
	$sql = "select * from postpage.`links` where `article_url` = '{$urlsrch}'";
	echo "\n<!--  {$sql} -->\n<br />";
	
	$db_found    = mysqli_query($link, $sql); 

	$row = mysqli_fetch_row($db_found);
	
	mysqli_close($link);

 	return $row;
}



function insertrec($id, $newurl) 
{

	$dbhost = "localhost";
	$db = "postpage";
	$dbuser  = "root";
	$dbpass  = "admin";

	
	$link = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

	if (!$link) {
    	die('Connect Error (' . mysqli_connect_errno() . ') '
                            . mysqli_connect_error());
	} 			
			
	// $sql = "INSERT INTO `links` ( `lid`, `domain` ) 
	//                VALUES ('".$id."', ' ')";

	$parse = parse_url($newurl, PHP_URL_HOST);;


	$sql = "INSERT INTO `links` ( `lid`, `domain`, `article_url` ) 
	               VALUES ('".$id."', '".$parse."', '".$newurl."' )";
	echo "\n<!--  {$sql} -->\n<br />";
	
	$db_found    = mysqli_query($link, $sql); 

	if (!$db_found) {
    	trigger_error('Unable to execute query: ' . $querySql, E_USER_NOTICE);
	}

	mysqli_close($link);
	
	return;
}

function bitly_get_curl($uri) {
  $output = "";
  try {
    $ch = curl_init($uri);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 4);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $output = curl_exec($ch);
  } catch (Exception $e) { 
  }
  return $output;
}

function nextrec() {

	$chars = ' aXm0HNJ_I1qoQbAet4uOEBTD92f5C8gZ3sclyVGL6xPdrYnw-vjWURFhK7kSMipz';

	$data = getmax();
	echo "\nthis is the \$data variable = \n";
	var_dump($data);
	echo "\n\n\n";
	// $data = getrec();
	// $C1 = strpos($chars, substr($output, 0, 1));
	// $C2 = strpos($chars, substr($output, 1, 1));
	// $C3 = strpos($chars, substr($output, 2, 1));
	// $C4 = strpos($chars, substr($output, 3, 1));

	$C1 = strpos($chars, substr($data[0], 0, 1));
	$C2 = strpos($chars, substr($data[0], 1, 1));
	$C3 = strpos($chars, substr($data[0], 2, 1));
	$C4 = strpos($chars, substr($data[0], 3, 1));
	$C5 = strpos($chars, substr($data[0], 4, 1));

	echo " EXT IN: '".$data[0]."'\n<br>";

	if(!$C1) { $C1 = 0;}

	echo " \$C1: '".$C1."'\n<br>";
	echo " \$C2: '".$C2."'\n<br>";
	echo " \$C3: '".$C3."'\n<br>";
	echo " \$C4: '".$C4."'\n<br>";
	echo " \$C5: '".$C5."'\n<br>";



	$C1++;

	if ($C1 == 65)
	{
		/* 64 = 64 */
		$C1 = 1;
		if(!$C2) { $C2 = 1; } else { $C2++; }
	}

	if ($C2 == 65)
	{
		/* 64 x 64  = 4,096   */
		$C2 = 1;
		if(!$C3) { $C3 = 1; } else {$C3++;}
	}

	if ($C3 == 65)
	{
		/* 64 x 64 x 64  = 262,144 */
		$C3 = 1;
		if(!$C4) { $C4 = 1; } else {$C4++;}
	}

	if ($C4 == 65)
	{
		/* 64 x 64 x 64 x 64 = 16,777,216   */
		$C4 = 1;
		if(!$C5) { $C5 = 1; } else {$C5++;}
	}

	if ($C5 == 65)
	{
		/* 64 x 64 x 64 x 64 x 64 = 1,073,741,824  */
	}

	$Cout5 = substr($chars, $C5, 1);
	$Cout4 = substr($chars, $C4, 1);
	$Cout3 = substr($chars, $C3, 1);
	$Cout2 = substr($chars, $C2, 1);
	$Cout1 = substr($chars, $C1, 1);

	$CoutAll = $Cout1 . $Cout2 . $Cout3 . $Cout4. $Cout5;

	echo "EXT OUT: '".$CoutAll."'\n<br>\n<br>";
	return $CoutAll;
}

?>