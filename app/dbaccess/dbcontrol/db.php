<?php
	require_once 'companies.php';
	$domainsCompany = domainsCompany ();

	define ( 'HOST' , 'localhost' );
	define ( 'USER' , 'commomku_schoole' );
	//define ( 'DATABASE', 'schoolcare' );
	define ( 'PASSWORD' , "e29Ze$%Jjh0Y;Q76n678fPX" );

	if ( session_status () === PHP_SESSION_ACTIVE ) {
		$doComp = $_SESSION[ 'vdomainv' ];
		if ( array_key_exists ( $doComp , $domainsCompany ) ) {
			define ( 'DATABASE', $domainsCompany[ $doComp ] );
		}
		else {
			define ( 'DATABASE', 'wrong' );
		}

	}
	else {
		session_start ();
		$doComp = $_SESSION[ 'vdomainv' ];
		if ( array_key_exists ( $doComp , $domainsCompany ) ) {
			define ( 'DATABASE', $domainsCompany[ $doComp ] );
		}
		else {
			define ( 'DATABASE', 'legalwar_test' );
		}

	}
