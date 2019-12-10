<?php

	include '../checkReqst.php';
// print $USER_ID ;
	include_once '../../dbaccess/classes/DBJobPositions.php';

	$jobPosObj = new DBJobPositions( USER, PASSWORD, DATABASE );

	if ( isset( $_POST[ 'updateJobTitle' ] ) ) {
		$rec_id =(int) $_POST[ 'updateJobID' ];
		$title = $_POST[ 'updateJobTitle' ];
		$description = $_POST[ 'updateJobDescription' ];
		$res = $jobPosObj->upDatePosition( $rec_id , $title, $description );
		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}

	if ( isset( $_POST[ 'delete' ] ) ) {
		$record_id = (int)$_POST[ 'delete' ];

		$res = $jobPosObj->deletePosition( $record_id );
		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}
	if ( isset( $_POST[ 'newJobTitle' ] ) ) {
		$title = $_POST[ 'newJobTitle' ];
		$description = $_POST[ 'newJobDescription' ];
		$res = $jobPosObj->saveNewPosition( $title, $description );
		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}


