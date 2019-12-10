<?php

	include '../checkReqst.php';
	// print $USER_ID ;
	include_once '../../dbaccess/classes/DBEmployees.php';
	include_once '../../dbaccess/classes/DBJobPositions.php';
	$emplObj = new DBEmployees( USER, PASSWORD, DATABASE );
	$jobPositionsObj = new DBJobPositions( USER, PASSWORD, DATABASE );
	if ( isset( $_GET[ 'get_data' ] ) ) {
		$res  = $emplObj->getAllEmployees();

		$view ['emp'] = $res;
		$view ['jobpos'] = $jobPositionsObj->getAllPositions();

		print json_encode( $view, JSON_THROW_ON_ERROR, 512 );
		exit;
	}
