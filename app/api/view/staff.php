<?php

	include '../checkReqst.php';
	// print $USER_ID ;
	include_once '../../dbaccess/classes/DBEmployees.php';
	$emplObj = new DBEmployees( USER, PASSWORD, DATABASE );
	if ( isset( $_GET[ 'get_data' ] ) ) {
		$res  = $emplObj->getAllEmployees();

		$view ['emp'] = $res;

		print json_encode( $view, JSON_THROW_ON_ERROR, 512 );
		exit;
	}
