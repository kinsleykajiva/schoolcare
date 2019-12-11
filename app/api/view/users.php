<?php
	include '../checkReqst.php';
	// print $USER_ID ;

if(isset($_GET['get_def'])){
	$view ['users'] =$usersObj->getAllUsers();
	$view ['roles'] =$usersObj->getAllRoles();
	$view ['empl_no_acc'] =$usersObj->getEmployeesWithOutUserAccounnts();

	print json_encode( $view, JSON_THROW_ON_ERROR, 512 );
	exit;
}