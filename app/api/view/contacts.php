<?php

	include '../checkReqst.php';

	//print $USER_ID ;
	include_once '../../dbaccess/classes/DBGeneralContact.php';
	$contactObj = new DBGeneralContact( USER, PASSWORD, DATABASE );

	if(isset($_GET['export_csv'])){
		$export_csv = $contactObj->getContactsExport();
		$path = '../../../public/';
		$folderPath = $path . 'csv/' . date( 'Y-m' )  . '/';
		$downloadPath = $folderPath  . 'Contacts CSV ' . '-' . date( 'm.d.y' ) . '.csv';
		try {
			if ( !file_exists( $folderPath ) ) {
				if ( !mkdir( $concurrentDirectory = $folderPath , 0777 , TRUE ) && !is_dir( $concurrentDirectory ) ) {
					throw new \RuntimeException( sprintf( 'Directory "%s" was not created' , $concurrentDirectory ) );
				}
			}
			$res['status'] = 'ok';
			$res[ 'path' ] = $downloadPath;
		} catch( Exception $e ) {
			$res['status'] = 'fail';
			$res[ 'message' ] = $e->getMessage();
		}
		$fp = fopen($downloadPath, 'w');
		fputcsv($fp, [ 'Name', 'Surname', 'Organisation',  'Date Created',  'Email' ,'Contact','Address' ,'Employee Full Name']);
		foreach ($export_csv as $val) {
			fputcsv($fp, $val);
		}

		fclose($fp);

		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}

	if(isset($_GET['def_cont'])){
		$res['gen_contacts'] = $contactObj->getContacts();

		print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
		exit;
	}

