<?php
	include '../checkReqst.php';

	include_once '../../dbaccess/classes/DBFeesHandler.php';
	//print $USER_ID ;
	$feesHandlerObj = new DBFeesHandler( USER , PASSWORD , DATABASE );

	if ( isset( $_GET[ 'get_def' ] ) ) {
		$getyear = $_GET['get_def'];
		$getyear = $getyear === '00'? '' : $getyear;
		$view[ 'postedChildren' ] = $feesHandlerObj->getPostedChildrenForFinancialYear($getyear);
		$view[ 'paymentmethods' ] = $feesHandlerObj->getPaymentMethods();
		$view[ 'fee_items' ] = $feesHandlerObj->getFeesItems();
		$view[ 'years' ] = $feesHandlerObj->getFinancialYears();
		$view[ 'fees_packages' ] = $feesHandlerObj->getFeesPackages();
		$view[ 'paymentPeriods' ] = $feesHandlerObj->getPaymentPeriods();

		print json_encode( $view , JSON_THROW_ON_ERROR , 512 );
		exit;
	}