<?php

	include_once '../../dbaccess/dbcontrol/db.php';

	include_once '../../dbaccess/classes/DBUsers.php';
	$username = $_POST['username'];
	$password = $_POST['password'];
	$usersObj = new DBUsers( USER , PASSWORD , DATABASE );


	$res = $usersObj->loginUser($username , $password);

	print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
	exit;