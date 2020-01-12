<?php
	require_once 'companies.php';
	$domainsCompany = domainsCompany ();

	define ( 'HOST' , 'localhost' );
	define ( 'USER' , 'schoofhf_xrootx' );
	//define ( 'DATABASE', 'schoolcare' );
	define ( 'PASSWORD' , 'r3454FGy4mTop)h@3U8DY');

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
			define ( 'DATABASE', 'schoofhf_test' );
		}

	}
