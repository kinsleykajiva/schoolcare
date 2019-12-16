<?php

	include '../checkReqst.php';
	// print $USER_ID ;
	// print $ROLE_ID ;
	include_once '../../dbaccess/classes/DBEmployees.php';

	$emplObj = new DBEmployees( USER, PASSWORD, DATABASE );

	if(isset($_GET['get_att'])){
		$view ['def_empl_select'] = $USER_ID;
		$view ['att'] = $emplObj->getAllAttendance();
		$view ['empl'] = $emplObj->getAllEmployees($USER_ID  , '' , $ROLE_ID);

		print json_encode( $view, JSON_THROW_ON_ERROR, 512 );
		exit;
	}

	if ( isset( $_GET[ 'get_data' ] ) ) {
		$res  = $emplObj->getAllEmployees();

		include_once '../../dbaccess/classes/DBJobPositions.php';
		$jobPositionsObj = new DBJobPositions( USER, PASSWORD, DATABASE );
		$view ['emp'] = $res;
		$view ['jobpos'] = $jobPositionsObj->getAllPositions();

		print json_encode( $view, JSON_THROW_ON_ERROR, 512 );
		exit;
	}
