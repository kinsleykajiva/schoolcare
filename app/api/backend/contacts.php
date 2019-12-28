<?php

	include '../checkReqst.php';

	//print $USER_ID ;
	include_once '../../dbaccess/classes/DBGeneralContact.php';
	$contactObj = new DBGeneralContact( USER, PASSWORD, DATABASE );

	if(isset($_POST['rec_id_edit'])){
		$record_id = $_POST['rec_id_edit'];
		$res= $contactObj->deleteContact($record_id );

		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}

	if(isset($_POST['editSelectType'])){
		$id_rec  = $_POST['id_rec'];
		$SelectType  = $_POST['editSelectType'];
		$Name  = $_POST['editName'];
		$Surname  = $_POST['editSurname'];
		$Org  = $_POST['editOrg'];
		$Email  = $_POST['editEmail'];
		$Phone  = $_POST['editPhone'];
		$Address  = $_POST['editAddress'];


		$res= $contactObj->updateContact($id_rec ,$Name , $Surname,$Org , $Email , $Phone ,$Address);

		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}

	if(isset($_POST['newSelectType'])){
		$SelectType  = $_POST['newSelectType'];
		$Name  = $_POST['newName'];
		$Surname  = $_POST['newSurname'];
		$Org  = $_POST['newOrg'];
		$Email  = $_POST['newEmail'];
		$Phone  = $_POST['newPhone'];
		$Address  = $_POST['newAddress'];


		$res= $contactObj->saveContact($Name , $Surname,$Org , $Email , $Phone , $USER_ID,$Address);

		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}

