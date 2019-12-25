<?php
	include '../checkReqst.php';

	include_once '../../dbaccess/classes/DBFeesHandler.php';
	//print $USER_ID ;
	$feesHandlerObj = new DBFeesHandler( USER, PASSWORD, DATABASE );

	if(isset($_POST['editPackagerec_id'])){
		$editPackagerec_id = $_POST['editPackagerec_id'];
		$newPackageTitle = $_POST['editPackageTitle'];
		$PaymentPeriod = $_POST['editfeePaymentPeriodSelects'];
		$feeItemSelects = $_POST['editfeeItemSelects'];
		$res = $feesHandlerObj->editFeesPackage($editPackagerec_id , $newPackageTitle ,$feeItemSelects , $PaymentPeriod);
		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}
	if(isset($_POST['newPackageTitle'])){
		$newPackageTitle = $_POST['newPackageTitle'];
		$PaymentPeriod = $_POST['feePaymentPeriodSelects'];
		$feeItemSelects = $_POST['feeItemSelects'];
		$res = $feesHandlerObj->createFeesPackage($newPackageTitle ,$feeItemSelects , $PaymentPeriod);
		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}
	if(isset($_POST['edit_rec_id'])){
		$FeeTitle = $_POST['editFeeTitle'];
		$FeeAmount = $_POST['editFeeAmount'];
		$edit_rec_id = $_POST['edit_rec_id'];


		$res =$feesHandlerObj->editFeesItem($edit_rec_id , $FeeTitle ,(double) $FeeAmount);
			print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}
if(isset($_POST['newFeeTitle'])){
		$newFeeTitle = $_POST['newFeeTitle'];
		$newFeeAmount = $_POST['newFeeAmount'];


		$res =$feesHandlerObj->saveFeesItem($newFeeTitle ,(double) $newFeeAmount);
			print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}

