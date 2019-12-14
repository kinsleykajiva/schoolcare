<?php

	include '../checkReqst.php';
	// print $USER_ID ;

	include_once '../../dbaccess/classes/DBChildParents.php';
	include_once '../../dbaccess/classes/DBChildren.php';
	if ( isset( $_POST[ '' ] ) ) {

	/*$ = $_POST[''];
	$ = $_POST[''];
	$ = $_POST[''];
	$ = $_POST[''];
	$ = $_POST[''];
	$ = $_POST[''];
	$ = $_POST[''];
	$ = $_POST[''];
	$ = $_POST[''];
	$ = $_POST[''];
	$ = $_POST[''];*/
	$record_id = $_POST[''];
		$parentObj = new DBChildParents( USER, PASSWORD, DATABASE );
		$childrenObj = new DBChildren( USER, PASSWORD, DATABASE );

	}


