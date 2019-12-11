<?php


	include '../checkReqst.php';
	// print $USER_ID ;
	include_once '../../dbaccess/classes/DBEmployees.php';
	include_once '../../dbaccess/classes/DBJobPositions.php';
	include_once '../../dbaccess/classes/FileAccess.php';

	if(isset($_POST['delete_empl'])){
		$employeeID = $rec_id =(int)$_POST['delete_empl'];
		$emplObj = new DBEmployees( USER, PASSWORD, DATABASE );
		$res = $emplObj->deleteEmployee($rec_id);

		if($res['status' ]=== 'ok'){
			$picFileFolder = '../../../storage/files/' . DATABASE . "/employees/{$employeeID}/picture/";
			$fileFolder = '../../../storage/files/' . DATABASE . "/employees/{$employeeID}/documents/";

			FileAccess::delete_files($picFileFolder);
			FileAccess::delete_files($fileFolder);
		}
		echo json_encode($res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}

	if ( isset( $_POST[ 'surname' ] ) ) {
		$name = $_POST[ 'name' ];
		$type_send = $_POST[ 'type_send' ];
		$record_id = $_POST[ 'record' ] ?? 0;
		$surname = $_POST[ 'surname' ];
		$id_num = $_POST[ 'id_num' ];
		$phone = $_POST[ 'phone' ];
		$sex = $_POST[ 'sex' ];
		$date_of_birth = $_POST[ 'date_of_birth' ];
		//$pics = $_POST['pics'];
		$email = $_POST[ 'email' ];
		$address = $_POST[ 'address' ];
		$select_jobPosition = $_POST[ 'select_jobPosition' ];
		//$docss = $_POST['docss'];
		$employeeID = '0';
		$res = [];
		$emplObj = new DBEmployees( USER, PASSWORD, DATABASE );

		if($type_send === 'new') {

			$res = $emplObj->saveNewEmployee( $name, $surname, $date_of_birth, $id_num, $USER_ID, $sex, $select_jobPosition, $phone, $address, $email );
			$employeeID = $res['extra']['lastID'];
		}elseif($type_send === 'edit'){

			$employeeID = $record_id;
			$res = $emplObj->saveUpdateEmployee($record_id ,  $name, $surname, $date_of_birth, $id_num, $USER_ID, $sex, $select_jobPosition, $phone, $address, $email );


		}
		if($res['status'] !== 'ok'){
			echo json_encode($res, JSON_THROW_ON_ERROR, 512 );
			exit;
		}

		$fileFolder = '../../../storage/files/' . DATABASE . "/employees/{$employeeID}/documents/";
		if(isset($_FILES['pics']['name'])){
			$picFileFolder = '../../../storage/files/' . DATABASE . "/employees/{$employeeID}/picture/";
			$res = FileAccess::uploadSingleFiles( $picFileFolder, 'pics' );
		}

		if (isset($_FILES['docss']['name'])) {



			list( $ext, $succeeded, $failed ) = FileAccess::uploadMultipleFiles( $fileFolder, 'docss' );
			if ( count( $succeeded ) > 0 ) {
				$res =  array(
					'status' => 'ok',
				);
				print json_encode($res, JSON_THROW_ON_ERROR, 512 );exit;
			}
			echo json_encode( array(
				'status' => 'error',
			), JSON_THROW_ON_ERROR, 512 );
		}
		print json_encode($res, JSON_THROW_ON_ERROR, 512 );exit;
		;

	}
