<?php


	function parseLoginUserEmail ( $user_email_name )
		: array {
			if ( empty( $user_email_name ) ) {
				return NULL;
			}
			$str = 'username@domain.com';

			$user_email_name = strip_tags ( strtolower ( trim ( $user_email_name ) ) );
			$user_email_name = preg_replace ( '/\s+/' , '' , $user_email_name );// remove white spaces in string

			$username        = explode ( "@" , $user_email_name )[ 0 ]; //username
			$domain          = explode ( "@" , $user_email_name )[ 1 ]; // domain.com
			$userGroup       = explode ( "." , $domain )[ 0 ]; //domain

			return array (
				'user_name' => trim ( $username ) ,
				'company'   => trim ( $userGroup ),
			);
		}


	$username = $_POST['username'];
	$password = $_POST['password'];

	if(!filter_var($username , FILTER_VALIDATE_EMAIL)){
				print 'error_parse';
				exit;
			}

$dataResponse = parseLoginUserEmail($username);

$username = $dataResponse['user_name'];
		$domain = $dataResponse['company'];

		if (session_status() == PHP_SESSION_NONE) {
					session_start();
					$doComp = $_SESSION['vdomainv'] = $domain ;
				}

	include_once '../../dbaccess/dbcontrol/db.php';
	if(DATABASE === 'wrong'){
			print 'lol_non_wrong'; // this domain is not registerd with us
			exit;
		}
include_once '../../dbaccess/classes/DBUsers.php';

$usersObj = new DBUsers( USER , PASSWORD , DATABASE );
	$res = $usersObj->loginUser($username , $password);

	print json_encode( $res, JSON_THROW_ON_ERROR, 512 );
	exit;
