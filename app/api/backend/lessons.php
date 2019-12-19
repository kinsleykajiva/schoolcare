<?php


	include '../checkReqst.php';
	// print $USER_ID ;
	// print $ROLE_ID ;

	include_once '../../dbaccess/classes/DBLessonsAll.php';
	$lessonsObj = new DBLessonsAll( USER , PASSWORD , DATABASE );

	if(isset($_POST['delete_lesion_id'])){
		$id =(int) $_POST['delete_lesion_id'];
		$res = $lessonsObj->deleteClass( $id);
		print json_encode( $res , JSON_THROW_ON_ERROR , 512 );
		exit;
	}
	if(isset($_POST['idsLessons'])){
		$idsLessons = $_POST['idsLessons'];
		$idsLessonsArr = explode(',',$idsLessons);
		$DateSelected = $_POST['lastDateSelected'];
		$DaySelected = $_POST['lastDaySelected'];
		$res = [];
		foreach ($idsLessonsArr as  $idsLesson){

			$res = $lessonsObj->saveClassLesson($idsLesson,$DateSelected ,$USER_ID,'');
		}

		print json_encode( $res , JSON_THROW_ON_ERROR , 512 );
		exit;
	}


	if ( isset( $_POST[ 'newLesson_title' ] ) ) {
		$title = $_POST[ 'newLesson_title' ];
		$categoy = $_POST[ 'newLesson_categoy' ];
		$description = $_POST[ 'newLesson_description' ];
		$ages = $_POST[ 'newLesson_ages' ];
		$milestones = $_POST[ 'newLesson_milestones' ];
		$res = $lessonsObj->saveNewLesson( $title , $categoy , $description , $ages , $milestones );
		print json_encode( $res , JSON_THROW_ON_ERROR , 512 );
		exit;

	}