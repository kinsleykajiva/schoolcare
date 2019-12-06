<?php
	require_once 'companies.php';
	$domainsCompany = domainsCompany ();

	define ( 'HOST' , 'localhost' );
	define ( 'USER' , 'root' );
	define ( 'DATABASE', 'schoolcare' );
	define ( 'PASSWORD' , "" );

	/*if ( session_status () === PHP_SESSION_ACTIVE ) {
		$doComp = $_SESSION[ 'xdomainx' ];
		if ( array_key_exists ( $doComp , $domainsCompany ) ) {
			define ( 'DATABASE', $domainsCompany[ $doComp ] );
		}
		else {
			define ( 'DATABASE', 'wrong' );
		}

	}
	else {
		session_start ();
		$doComp = $_SESSION[ 'xdomainx' ];
		if ( array_key_exists ( $doComp , $domainsCompany ) ) {
			define ( 'DATABASE', $domainsCompany[ $doComp ] );
		}
		else {
			define ( 'DATABASE', 'legalwar_test' );
		}

	}*/