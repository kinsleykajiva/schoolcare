<?php

	include '../checkReqst.php';
	// print $USER_ID ;

	include_once '../../dbaccess/classes/DBRooms.php';
	$roomsObj = new DBRooms( USER, PASSWORD, DATABASE );

	if(isset($_POST['sent_type_edit'])){
		$newRoomName = $_POST['newRoomName'];
		$newAgeRanges =(int) $_POST['newAgeRanges'];
		$record_id =(int) $_POST['sent_type_edit'];



		$res = $roomsObj->editRoom($record_id , $newRoomName , $newAgeRanges);

		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}


	if(isset($_POST['sent_type_new'])){
		$newRoomName = $_POST['newRoomName'];
		$newAgeRanges =(int) $_POST['newAgeRanges'];
		$sent_type_new = $_POST['sent_type_new'];

		$res = $roomsObj->saveNewRoom($newRoomName , $newAgeRanges);

		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}



