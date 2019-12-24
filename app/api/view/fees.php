<?php
	include '../checkReqst.php';

	include_once '../../dbaccess/classes/DBFeesHandler.php';
	//print $USER_ID ;
	$feesHandlerObj = new DBFeesHandler( USER , PASSWORD , DATABASE );

	if ( isset( $_GET[ 'get_def' ] ) ) {
		$view[ 'paymentmethods' ] = $feesHandlerObj->getPaymentMethods();
		$view[ 'fee_items' ] = $feesHandlerObj->getFeesItems();
		$view[ 'fees_packages' ] = $feesHandlerObj->getFeesPackages();
		$view[ 'paymentPeriods' ] = $feesHandlerObj->getPaymentPeriods();
		$view[ 'postedChildren' ] = $feesHandlerObj->getPostedChildrenForFinancialYear();
		print json_encode( $view , JSON_THROW_ON_ERROR , 512 );
		exit;
	}