<?php

	include '../access.php';
	include_once '../../dbaccess/dbcontrol/db.php';
	include_once '../../dbaccess/classes/DBUsers.php';
	$usersObj = new DBUsers( USER , PASSWORD , DATABASE );
	$USER_ID = 0;
	$token = getAuthorizationHeader();
	if($token === NULL || empty($token)){
		print $AUTH;exit;
	}
	$arr = $usersObj->deduceTokenAccess($token);
	$USER_ID = $arr['userID'] ;
	$ROLE_ID = $arr['roleID'] ;
