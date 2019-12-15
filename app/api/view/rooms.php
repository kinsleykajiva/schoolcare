<?php

	include '../checkReqst.php';
	// print $USER_ID ;

	include_once '../../dbaccess/classes/DBRooms.php';
	include_once '../../dbaccess/classes/DBAgeRanges.php';
	$roomsObj = new DBRooms( USER, PASSWORD, DATABASE );
	$ageRangeObj = new DBAgeRanges( USER, PASSWORD, DATABASE );

	if(isset($_GET['get_def'])){
		$view ['rooms'] = $roomsObj->getRooms();
		$view ['ages'] = $ageRangeObj->getAllAgeRanges();

		print json_encode( $view, JSON_THROW_ON_ERROR, 512 );
		exit;
	}



