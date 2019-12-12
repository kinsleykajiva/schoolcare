<?php
	include '../checkReqst.php';

	//print $USER_ID ;
	include_once '../../dbaccess/classes/DBChildren.php';
	$childrenObj = new DBChildren( USER, PASSWORD, DATABASE );

	if(isset($_GET['rec_get'])){
		$id = $_GET['rec_get'] ;
		$res['childDetails'] = $childrenObj->getChild($id);

		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}
	if(isset($_GET['get_def'])){
		$res['children'] = $childrenObj->getAllChildren();

		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}

