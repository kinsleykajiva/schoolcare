<?php

	include '../checkReqst.php';
	// print $USER_ID ;
	// print $ROLE_ID ;

	include_once '../../dbaccess/classes/DBLessonsAll.php';
	include_once '../../dbaccess/classes/DBAgeRanges.php';
	$lessonsObj = new DBLessonsAll( USER , PASSWORD , DATABASE );
	$agesObj = new DBAgeRanges( USER , PASSWORD , DATABASE );

	if(isset($_GET['def_get'])){
		$view ['lessons'] = $lessonsObj->getAllLessons();
		$view ['milestones'] = $lessonsObj->getMileStones();
		$view ['lesscategory'] = $lessonsObj->getlessonsCategory();
		$view ['age_range'] = $agesObj->getAllAgeRanges();

		print json_encode( $view , JSON_THROW_ON_ERROR , 512 );
		exit;
	}
