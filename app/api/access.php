<?php

	$AUTH = 'auth';

	/**
	 * Get header Authorization
	 * */
	

	function getAuthorizationHeader ()
	{
		$headers = null;
		if ( isset( $_SERVER[ 'Header12' ] ) ) {
			
			$headers = trim( $_SERVER[ "Header12" ] );
		//	print_r('errr');exit;
		} else if ( isset( $_SERVER[ 'HTTP_AUTHORIZATION' ] ) ) { //Nginx or fast CGI
			$headers = trim( $_SERVER[ "HTTP_AUTHORIZATION" ] );
			//print_r('rrrr');exit;
		} elseif ( function_exists( 'apache_request_headers' ) ) {
			$requestHeaders = apache_request_headers();
			// Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
			$requestHeaders = array_combine( array_map( 'ucwords', array_keys( $requestHeaders ) ), array_values( $requestHeaders ) );
			//var_dump($requestHeaders);
			
			if ( isset( $requestHeaders['Header12'] ) ) {
				$headers = $requestHeaders['Header12'];
			}
			//var_dump($requestHeaders['Header12']);
			//print_r('uuuu7777');
			//exit;
		}else{
			//print_r('uuuuuu');exit;
			$headers = 'auth';
		}
		return $headers;
	}
