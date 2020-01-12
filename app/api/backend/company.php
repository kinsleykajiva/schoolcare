<?php

include '../checkReqst.php';
// print $USER_ID ;
// print $ROLE_ID ;

include_once '../../dbaccess/classes/DBCompanyDetails.php';
include_once '../../dbaccess/classes/FileAccess.php';
$companyObj = new DBCompanyDetails(USER, PASSWORD, DATABASE);

if (isset($_POST['newOrg'])) {
	$Org     = $_POST['newOrg'];
	$Email   = $_POST['newEmail'];
	$Phone   = $_POST['newPhone'];
	$Address = $_POST['newAddress'];
	$Org     = $_POST['newOrg'];
	$log     = $_FILES['newLogo']['name'];
	$log = str_replace( array( "#", "?", "/" ), '_', $log );
	$log = str_replace( array( ' ', '-', "'" ), array( '_', '_', '' ), $log );
	//$_FILES['newLogo']
	$res        = null;
	$fileFolder = '../../../storage/files/'.DATABASE."/company/files/";
	if (isset($_FILES['newLogo']['name'])) {

		$res = FileAccess::uploadSingleFiles($fileFolder, 'newLogo');
	}
	if (!is_null($res)) {
		if ($res === 'fail') {
			echo json_encode(['status' => 'Error'], JSON_THROW_ON_ERROR, 512);
			exit;
		}
		
		$res = $companyObj->saveCompanyDetails($Org, $Address, $Phone, $Email, $fileFolder.$log);
	}

	echo json_encode($res, JSON_THROW_ON_ERROR, 512);
	exit;
}
