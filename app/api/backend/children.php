<?php

	include '../checkReqst.php';
	// print $USER_ID ;

	include_once '../../dbaccess/classes/DBChildParents.php';
	include_once '../../dbaccess/classes/DBChildren.php';
	$parentObj = new DBChildParents( USER , PASSWORD , DATABASE );
	$childrenObj = new DBChildren( USER , PASSWORD , DATABASE );

	if ( isset( $_POST[ 'delete_rec' ] ) ) {
		$res = $childrenObj->deleteRecord( $_POST[ 'delete_rec' ] );
		print json_encode( $res , JSON_THROW_ON_ERROR , 512 );
		exit;
	}

	if ( isset( $_POST[ 'child_edit_rec' ] ) ) {
		$rec_id = $_POST[ 'child_edit_rec' ];
		$childName = $_POST[ 'childName' ];
		$childSurname = $_POST[ 'childSurname' ];
		$childSex = $_POST[ 'childSex' ];
		$childDOB = $_POST[ 'childDOB' ];
		$childNotes = $_POST[ 'childNotes' ];
		$res = $childrenObj->updateChild( $rec_id , $childName , $childSurname , $childSex , $childDOB , $childNotes );
		print json_encode( $res , JSON_THROW_ON_ERROR , 512 );
		exit;
	}

	if ( isset( $_POST[ 'parent_edit_rec_id' ] ) ) {

		$rec_id = $_POST[ 'parent_edit_rec_id' ];
		$parentName = $_POST[ 'parentName' ];
		$parentSurname = $_POST[ 'parentSurname' ];
		$parentIDNumber = $_POST[ 'parentIDNumber' ];
		$parentSex = $_POST[ 'parentSex' ];
		$parentOccupation = $_POST[ 'parentOccupation' ];
		$parentPhone = $_POST[ 'parentPhone' ];
		$parentEmail = $_POST[ 'parentEmail' ];
		$parentHomeAddress = $_POST[ 'parentHomeAddress' ];

		$res = $parentObj->updateParent( $rec_id , $parentName , $parentSurname , $parentIDNumber , $parentSex , $parentOccupation , $parentEmail , $parentHomeAddress );
		print json_encode( $res , JSON_THROW_ON_ERROR , 512 );
		exit;

	}


