<?php

	include '../checkReqst.php';
	// print $USER_ID ;
    // print $ROLE_ID ;
    include_once '../../dbaccess/classes/DBEmployees.php';
  
	$employObj = new DBEmployees( USER , PASSWORD , DATABASE );
   
    

   
    if(isset($_GET['def_get'])){

        $view ['data'] =$employObj->getEmployee($USER_ID);

        print json_encode( $view, JSON_THROW_ON_ERROR, 512 );
		exit;
    }
