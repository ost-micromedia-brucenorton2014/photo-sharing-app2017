<?php
	require_once  '_includes/connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	//define table
	$tbl = "photos";//change table name as required
	//write query
	$query = "SELECT $tbl.photoID, $tbl.photoSRC, $tbl.photoCaption FROM $tbl ORDER BY $tbl.photoID DESC";
	//prepare statement, execute, store_result
	if($displayStmt = $mysqli->prepare($query)){
		$displayStmt->execute();
		$displayStmt->store_result();
	}
	//bind results
	$displayStmt->bind_result($photoID, $photoSRC, $photoCaption);

	//create an array for the results
	$imagesArray = [];

	//fetch results
	while($displayStmt->fetch()){
		//create array for json
		$imagesArray[] = [$photoID, $photoSRC, $photoCaption];

		//display the image
		//echo('<div class="col-sm-4"><figure>hi<img src="uploads/files/'.$photoSRC.'" class="img-fluid"><figcaption>'.$photoCaption.'</figcaption></figure></div>');
	}
	//encode the array in json format
	echo( json_encode($imagesArray));

?>
