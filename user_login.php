<?php
	require_once  '_includes/connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	//variables to control state
	$emailRegistered = "email default";
	$passwordMatched = "password default";
	$responseArray = [];
	$insertedRows = 0;
	//define table
	$users = "users";//change table name as required

	//if person entered a userName
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
			$passwordMatched = "password matched";
			$userID = $insertStmt->insert_id;
			$responseArray[] = [$insertedRows, $passwordMatched, $userID, $userName, $userEmail, $userPassword];//not really, but triggers uploader
		}
		
	//else if no userName, but a userEmail
	}else	if (!empty($_REQUEST["userEmail"])) {
    $userEmail = $_REQUEST["userEmail"];
    //echo($userEmail);
    //write query
	
		$query = "SELECT $users.userID, $users.userName, $users.userEmail, $users.userPassword FROM $users WHERE $users.userEmail = ?";
		//prepare statement, execute, store_result
		if($displayStmt = $mysqli->prepare($query)){
			$displayStmt->bind_param('s', $userEmail);
			$displayStmt->execute();
			$displayStmt->store_result();
			$numrows = $displayStmt-> num_rows;
		}
		
		if($numrows == 0){
			$emailRegistered = 'email not registered';
			$responseArray[] = [$emailRegistered];
		}
		//bind results
		$displayStmt->bind_result($userID, $userName, $userEmail, $userPassword);
		
		//create an array for the results
		
		//fetch results
		while($displayStmt->fetch()){

			if($numrows > 0){
				$emailRegistered = "email registered";
				//check to see if password matches
				if (!empty($_REQUEST["userPassword"])) {
			    $unhashedPassword = $_REQUEST['userPassword'];
				
					if( sha1($unhashedPassword) == $userPassword){
						$passwordMatched = "password matched";
					}else{
						$passwordMatched = "password not matched";
					}
			    //echo($userEmail);
				}else{  
				   $passwordMatched = "password not submitted";
				}
				
				//create array for json
				$responseArray[] = [$emailRegistered, $passwordMatched, $userID, $userName, $userEmail, $userPassword];
			}

			//display the image
			//echo('<div class="col-sm-4"><figure>hi<img src="uploads/files/'.$photoSRC.'" class="img-fluid"><figcaption>'.$photoCaption.'</figcaption></figure></div>');
		}

	}else{  
	   $emailRegistered = "email not submitted";
	   $responseArray[] = [$emailRegistered];
	}


	//encode the array in json format
	echo( json_encode($responseArray));

?>
