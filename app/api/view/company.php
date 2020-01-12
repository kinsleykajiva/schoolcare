<?php
include '../checkReqst.php';
// print $USER_ID ;
// print $ROLE_ID ;

include_once '../../dbaccess/classes/DBCompanyDetails.php';
include_once '../../dbaccess/classes/FileAccess.php';
$companyObj = new DBCompanyDetails(USER, PASSWORD, DATABASE);
if (isset($_GET['def_get'])) {
	$res['comp']['NAME']     = $companyObj->NAME;
	$res['comp']['ADDRESS']  = $companyObj->ADDRESS;
	$res['comp']['CONTACTS'] = $companyObj->CONTACTS;
	$res['comp']['EMAIL']    = $companyObj->EMAIL;
	$res['comp']['LOGO']     = $companyObj->LOGO;

	echo json_encode($res, JSON_THROW_ON_ERROR, 512);
	exit;
}