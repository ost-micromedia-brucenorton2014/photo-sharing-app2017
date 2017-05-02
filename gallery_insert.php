<?php
	require_once  '_includes/connect.php';
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	$tbl = "photos";//change table name as required
	$captionArray = array();
	$srcArray = array();
	$userArray = array();
	$insertedRows = 0;
	
	//create arrays for images and captions
	foreach($_REQUEST as $key => $value){
	  if(preg_match("/^photoCaption\w/", $key)){
	  	$captionArray[] = $value;
	  }else if(preg_match("/^photoSRC\w/", $key)){
	  	$srcArray[]= $value;
	  }
	}
	$userID = 1;
	for($i=0;$i<count($captionArray);$i++){
		//echo($captionArray[$i].','.$srcArray[$i]);
		$query = "INSERT INTO $tbl (photoSRC, photoCaption, userID) VALUES (?,?,?)";
		//prepare statement, execute, store_result
		if($insertStmt = $mysqli->prepare($query)){
			//update bind parameter types & variables as required
			//s=string, i=integer, d=double, b=blob
			$insertStmt->bind_param("ssi", $srcArray[$i], $captionArray[$i], $userID);
			$insertStmt->execute();
			$insertedID = $insertStmt->insert_id;
			$insertedRows += $insertStmt->affected_rows;
		}
	}


		echo($insertedRows);
		$insertStmt->close();
		$mysqli->close();

?>