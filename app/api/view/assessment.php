<?php

	include '../checkReqst.php';
// print $USER_ID ;
	// print $ROLE_ID ;
	include_once '../../dbaccess/classes/DBLessonsAll.php';
	include_once '../../dbaccess/classes/DBChildren.php';
	$lessonsObj = new DBLessonsAll( USER , PASSWORD , DATABASE );
	$childrenObj = new DBChildren( USER , PASSWORD , DATABASE );


	if(isset($_GET['get_deff'])){
		$view ['m_cates'] = $lessonsObj->getAllMileStonesCategories();
		$view ['children'] = $childrenObj->getAllChildren();
		$view ['markers'] = $childrenObj->getAllAssesmentMarkers();

		print json_encode( $view , JSON_THROW_ON_ERROR , 512 );
		exit;
	}
