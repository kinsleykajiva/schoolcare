<?php

	include '../checkReqst.php';

	//print $USER_ID ;
	include_once '../../dbaccess/classes/DBGeneralContact.php';
	$contactObj = new DBGeneralContact( USER, PASSWORD, DATABASE );

	if(isset($_GET['def_cont'])){
		$res['gen_contacts'] = $contactObj->getContacts();

		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}

