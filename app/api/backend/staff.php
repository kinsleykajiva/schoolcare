<?php


	include '../checkReqst.php';
	// print $USER_ID ;
	include_once '../../dbaccess/classes/DBEmployees.php';
	include_once '../../dbaccess/classes/DBJobPositions.php';
	include_once '../../dbaccess/classes/FileAccess.php';

	if(isset($_POST['surname'])){
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$id_num = $_POST['id_num'];
		$sex = $_POST['sex'];
		$date_of_birth = $_POST['date_of_birth'];
		//$pics = $_POST['pics'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$select_jobPosition = $_POST['select_jobPosition'];
		//$docss = $_POST['docss'];
		$employeeID = 1;

		$emplObj = new DBEmployees(USER , PASSWORD , DATABASE );


		$fileFolder = '../../../storage/files/' . DATABASE . "/employees/{$employeeID}/";
		list( $ext, $succeeded, $failed ) = FileAccess::uploadFiles($fileFolder ,'docss'  );
		echo json_encode( array(
			'status' => 'Done',
			'succeeded' => $succeeded,
			'failed' => $failed,
		), JSON_THROW_ON_ERROR, 512 );
		exit;

	}
