<?php
	require_once  '_includes/connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	//variables to control state
	$emailRegistered = "email default";
	$passwordMatched = "password default";
	$userRegistered = "user default";
	$responseArray = [];
	$insertedRows = 0;
	//define table
	$users = "users";//change table name as required

	//
	if (!empty($_REQUEST["userName"])) {
    $userEmail = $_REQUEST["userEmail"];
    $userPassword = sha1($_REQUEST["userPassword"]);
    $userName = $_REQUEST["userName"];
    //echo($userEmail);
    //write query
		$query = "INSERT INTO $users (userName, userEmail, userPassword ) VALUES (?,?,?)";
		//prepare statement, execute, store_result
		if($insertStmt = $mysqli->prepare($query)){
			//update bind parameter types & variables as required
			//s=string, i=integer, d=double, b=blob
			$insertStmt->bind_param("sss", $userName, $userEmail, $userPassword );
			$insertStmt->execute();
			//$insertedArray = $insertStmt->insert_id;
			$insertedRows += $insertStmt->affected_rows;
			$responseArray[] = ["inserted $insertedRows row"];
		}
		

	}else{  
	   $userRegistered = "user not registered";
	   $responseArray[] = [$userRegistered];
	}


	//encode the array in json format
	echo( json_encode($responseArray));

?>
