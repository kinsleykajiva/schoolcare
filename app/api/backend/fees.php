<?php
	include '../checkReqst.php';

	include_once '../../dbaccess/classes/DBFeesHandler.php';
	//print $USER_ID ;
	$feesHandlerObj = new DBFeesHandler( USER, PASSWORD, DATABASE );

	if(isset($_GET[''])){
		$res =1;
			print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}