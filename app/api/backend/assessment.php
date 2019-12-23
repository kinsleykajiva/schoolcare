<?php
	include '../checkReqst.php';
	// print $USER_ID ;
	// print $ROLE_ID ;
	include_once '../../dbaccess/classes/DBChildren.php';
	$childrenObj = new DBChildren( USER , PASSWORD , DATABASE );
	if(isset($_POST['post_ass'])){
		$arrData = $_POST['post_ass'];
		$arrData = json_decode( $arrData , TRUE , 512 , JSON_THROW_ON_ERROR );

		print_r($arrData['id']);
	}