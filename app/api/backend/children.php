<?php

	include '../checkReqst.php';
	// print $USER_ID ;
	// print $ROLE_ID ;

	include_once '../../dbaccess/classes/DBChildParents.php';
	include_once '../../dbaccess/classes/DBRooms.php';
	include_once '../../dbaccess/classes/DBChildren.php';
	$parentObj = new DBChildParents( USER , PASSWORD , DATABASE );
	$childrenObj = new DBChildren( USER , PASSWORD , DATABASE );
	$roomsObj = new DBRooms( USER , PASSWORD , DATABASE );

	if(isset($_POST['rec_signout_id'])){
		$rec_id = $_POST['rec_signout_id'];
		$time_out = $_POST['time'];
		$res = $childrenObj ->clockOutAttendance($rec_id ,$time_out);
		print json_encode( $res , JSON_THROW_ON_ERROR , 512 );
		exit;
	}

	if(isset($_POST['new_att'])){
		$kids_selected = $_POST['kids_selected'];
		$kids_selected = explode(',',$kids_selected);

		$new_att = $_POST['new_att'];
		$datetimepicker4 = $_POST['datetimepicker4'];
		$timepicker = $_POST['timepicker'];
		$select_rooms = $_POST['select_rooms'];

		foreach ($kids_selected as $kid){

			if($select_rooms === 'null'){
				// save very child selected to all rooms
				$rooms = $roomsObj->getRooms();
				foreach ($rooms as $room){
					$id_room =(int) $room['id'];
					$res  =$childrenObj->clockInAttendance($USER_ID , $timepicker , $datetimepicker4 , '',$kid , $id_room);
				}

			}else{
				$res  =$childrenObj->clockInAttendance($USER_ID , $timepicker , $datetimepicker4 , '',$kid , $select_rooms);
			}

		}

		print json_encode( $res , JSON_THROW_ON_ERROR , 512 );
		exit;

	}

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


