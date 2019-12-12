<?php

	include '../checkReqst.php';

	//print $USER_ID ;
	//print 'auth' ;

	include_once '../../dbaccess/classes/DBJobPositions.php';

	$jobPosObj = new DBJobPositions( USER, PASSWORD, DATABASE );
	if ( isset( $_GET[ 'get_def' ] ) ) {
		$res['jobPos'] = $jobPosObj->getAllPositions();

		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}

