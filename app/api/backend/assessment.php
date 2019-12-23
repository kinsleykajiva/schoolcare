<?php
	include '../checkReqst.php';
	// print $USER_ID ;
	// print $ROLE_ID ;
	include_once '../../dbaccess/classes/DBChildren.php';
	$childrenObj = new DBChildren( USER , PASSWORD , DATABASE );
	if(isset($_POST['post_ass'])){
		$arrData = $_POST['post_ass'];
		$arrData = json_decode( $arrData , TRUE , 512 , JSON_THROW_ON_ERROR )[0];
		$id_child = $arrData['id'];
		$dataArr = $arrData['data'];
		$res = [];
		foreach ($dataArr as $asses){
			$mileStone = $asses['mileStone'];
			$marker = $asses['vall'];
			$res = $childrenObj->saveChildAssesment($id_child , $marker , $USER_ID,$mileStone);
		}
		print json_encode( $res , JSON_THROW_ON_ERROR , 512 );
		exit;

	}